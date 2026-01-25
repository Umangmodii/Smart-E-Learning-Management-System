<?php

namespace App\Livewire\Admin;

use Livewire\Component;

class AdminDashboard extends Component
{
    public function render()
    {
        return view('livewire.admin.dashboard')
        ->layout('layouts.admin.main',['title' => 'Admin Dashboard']);
    }
}
