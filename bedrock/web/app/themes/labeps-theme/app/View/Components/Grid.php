<?php

declare(strict_types=1);

namespace App\View\Components;

use Illuminate\Contracts\View\View;
use Roots\Acorn\View\Component;

class Grid extends Component
{
    public function __construct(public string $columnClasses = 'grid-cols-1 lg:grid-cols-2 xl:grid-cols-3')
    {
    }

    public function render(): View
    {
        return $this->view('components.grid');
    }
}
