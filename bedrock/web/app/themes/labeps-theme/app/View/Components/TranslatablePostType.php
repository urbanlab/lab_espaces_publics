<?php

declare(strict_types=1);

namespace App\View\Components;

use Illuminate\View\{
    Component,
    View
};
use WP_Post_Type;

class TranslatablePostType extends Component
{
    public string $label;

    public function __construct(string $postType)
    {
        $label = '';
        $object = get_post_type_object($postType);

        if (
            $object instanceof WP_Post_Type
            && isset($object->labels->singular_name)
            && is_string($object->labels->singular_name)
        ) {
            $label = $object->labels->singular_name;
        }

        if (empty($label)) {
            $label = ucfirst($postType);
        }

        $this->label = $label;
    }

    public function render(): View
    {
        return view('components.translatable-post-type');
    }
}
