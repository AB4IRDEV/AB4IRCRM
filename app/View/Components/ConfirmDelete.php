<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ConfirmDelete extends Component
{
    public $route;
    public $message;

    public function __construct($route, $message = "Are you sure you want to delete this?")
    {
        $this->route = $route;
        $this->message = $message;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.confirm-delete');
    }
}
