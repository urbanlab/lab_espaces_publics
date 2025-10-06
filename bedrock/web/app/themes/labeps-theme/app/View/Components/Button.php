<?php

declare(strict_types=1);

namespace App\View\Components;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Button extends Component
{

    public string $text;
    public string $class;
    public string $icon;
    public $attributes;
    /**
     * Create a new component instance.
     * @param string $text
     * @param string $class
     * @param string $icon
     * @param array $attributes
     * @return void
     */
    public function __construct(string $text = 'Button', string $class = '', string $icon = '', array $attributes = [])
    {
        $this->text = $text;
        $this->class = $class;
        $this->icon = $icon;
        $this->attributes = $attributes;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|\Closure|string
    {
        return view('components.button');
    }
}
