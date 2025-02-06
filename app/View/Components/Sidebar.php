<?php

namespace App\View\Components;

use App\Models\User;
use Illuminate\View\Component;
use Illuminate\Support\Facades\Auth;

class Sidebar extends Component
{
    public $user;
    public $menus;

    public function __construct()
    {
        $this->user = Auth::user();
        $this->menus = $this->generateMenu();
    }

    private function generateMenu()
    {
        $menus = [
            'Main Menu' => [
                ['name' => 'Dashboard', 'icon' => 'dashboard', 'route' => 'dashboard'],
                ['name' => 'Permissions', 'icon' => 'permissions', 'route' => 'permissions'],
                ['name' => 'Analytics', 'icon' => 'monitoring', 'route' => 'analytics'],
            ],
            'General' => [
                ['name' => 'Permissions', 'icon' => 'folder', 'route' => 'permissions.index'],
                ['name' => 'Roles', 'icon' => 'groups', 'route' => 'roles.index'],
                ['name' => 'Transfer', 'icon' => 'move_up', 'route' => 'transfer'],
                ['name' => 'Reports', 'icon' => 'flag', 'route' => 'reports.index'],
                ['name' => 'Notifications', 'icon' => 'notifications_active', 'route' => 'notifications'],
            ],
            'Account' => [
                ['name' => 'Profile', 'icon' => 'account_circle', 'route' => 'profile.edit'],
                ['name' => 'Settings', 'icon' => 'settings', 'route' => 'settings'],
            ],
        ];
    
        // If user is an admin, add admin-specific menus
        if ($this->user && $this->user->hasRole('admin')) {
            $menus['Admin'] = [
                ['name' => 'User Management', 'icon' => 'manage_accounts', 'route' => 'admin.users'],
                ['name' => 'Permissions', 'icon' => 'lock', 'route' => 'admin.permissions'],
            ];
        }
    
        // Check if the routes exist, and remove items where the route doesn't exist
        foreach ($menus as $section => $items) {
            foreach ($items as $key => $item) {
                if (!\Route::has($item['route'])) {
                    unset($menus[$section][$key]); // Remove the menu item if route doesn't exist
                }
            }
        }
    
        return $menus;
    }
    
    public function render()
    {
        return view('components.sidebar');
    }
}
