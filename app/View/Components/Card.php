<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Card extends Component
{
    public $title;
    public $buttonText;
    public $buttonLink;

    public function __construct($title, $buttonText = null, $buttonLink = null)
    {
        $this->title = $title;
        $this->buttonText = $buttonText;
        $this->buttonLink = $buttonLink;
    }
    public function render(): View|Closure|string
    {
        return view('components.card');
    }
}
