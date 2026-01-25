<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\User;

class Users extends Component
{
    public $breadcrumbs = [];
    public function mount()
    {
        $this->breadcrumbs = [
            ['label' => 'Home', 'url' => url('/admin/users')],
            ['label' => 'Users List', 'url' => null],
        ];
    }
    public function render()
    {
        return view('livewire.admin.users',[
            'users' => User::with('profile')->get()
        ])
        ->layout('layouts.admin.main',['title' => 'Users List']);
    }
}
