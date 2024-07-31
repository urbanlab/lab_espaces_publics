<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Button extends Component
{

    public $text;
    public $class;
    public $icon;
    public $attributes;
    /**
     * Create a new component instance.
     * @param string $text
     * @param string $class
     * @param string $icon
     * @param array $attributes
     * @return void
     */
    public function __construct($text = 'Button', $class = '', $icon = '', $attributes = [])
    {
        $this->text = $text;
        $this->class = $class;
        $this->icon = $icon;
        $this->attributes = $attributes;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.button');
    }
}
