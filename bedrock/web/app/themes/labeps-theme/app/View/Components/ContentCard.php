<?php

declare(strict_types=1);

namespace App\View\Components;

use Illuminate\Contracts\View\View;
use Roots\Acorn\View\Component;

class ContentCard extends Component
{
    public function render(): View
    {
        return $this->view('components.content-card');
    }
}
