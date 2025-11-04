<?php

declare(strict_types=1);

namespace App\View\Components;

use Illuminate\View\View;
use Roots\Acorn\View\Component;
use Log1x\Crumb\Facades\Crumb;

class Breadcrumb extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * The breadcrumb items.
     *
     * @return mixed[]
     */
    public function items(): array
    {
        return Crumb::build()->toArray();
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return View|string
     */
    public function render(): string|View
    {
        return $this->view('components.breadcrumb');
    }
}
