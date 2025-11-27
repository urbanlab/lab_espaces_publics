<?php

declare(strict_types=1);

namespace App\View\Components;

use Illuminate\Contracts\View\View;
use Roots\Acorn\View\Component;

class FilterableArchive extends Component
{
    public function __construct(public array $taxonomies)
    {
    }

    public function render(): View
    {
        return $this->view('components.filterable-archive');
    }
}
