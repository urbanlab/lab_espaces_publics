<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Log1x\Navi\Navi as NaviBuilder;

use function App\normalize_url;

class Navigation extends Component
{
    public $primaryMenu;

    public function __construct()
    {
        $navi = new NaviBuilder(); 
        $this->primaryMenu = $this->primary_menu($navi); 
    }

    protected function primary_menu($navi) 
    {
        $navigation = $navi->build('primary_navigation');
    
        if ($navigation->isEmpty()) {
            return [
                'id' => null,
                'name' => null,
                'items' => [],
            ];
        }
    
        $items = $navigation->toArray();
        
        $cpts = get_post_types(['_builtin' => false], 'names');
        
        foreach ($items as &$item) {
            $item_url = normalize_url($item->url);
            foreach ($cpts as $cpt) {
                $archive_url = normalize_url(get_post_type_archive_link($cpt));
                if (is_post_type_archive($cpt) && $item_url === $archive_url) {
                    $item->active = true;
                    break;
                }
            }
        }
        unset($item);

        return [
            'id' => $navigation->get('term_id'),
            'name' => $navigation->get('name'),
            'items' => $items,
        ];
    }
    
    public function render()
    {
        return view('components.navigation');
    }
}
