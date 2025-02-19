<?php

namespace App\View\Components;

use App\Models\User;
use Illuminate\View\Component;
use Illuminate\Support\Facades\Auth;

class Navbar extends Component
{
    public $user;
    public $menus;

    public function __construct()
    {
        $this->user = Auth::user();
      
    }

    
    
    public function render()
    {
        return view('components.navbar');
    }
}
