<?php

declare(strict_types=1);

namespace App\View\Components;

use Illuminate\View\View;
use Roots\Acorn\View\Component;

class Alert extends Component
{
    public string $type;

    public ?string $message;

    public array $types = [
        'default' => 'text-indigo-50 bg-indigo-400',
        'success' => 'text-green-50 bg-green-400',
        'caution' => 'text-yellow-50 bg-yellow-400',
        'warning' => 'text-red-50 bg-red-400',
    ];

    public function __construct(string $type = 'default', ?string $message = null)
    {
        $this->type = $this->types[$type] ?? $this->types['default'];
        $this->message = $message;
    }

    public function render(): string|View
    {
        return $this->view('components.alert');
    }
}
