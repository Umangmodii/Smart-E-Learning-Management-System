<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\User;

class AdminDashboard extends Component
{
    public $breadcrumbs = [];

    public function mount()
    {
        $this->breadcrumbs = [
            ['label' => 'Home', 'url' => url('/')],
            ['label' => 'Dashboard', 'url' => null],
        ];
    }

    public function render()
    {
        $total_customer = User::where('role_id', 3)->count();
        $total_admin = User::where('role_id', 1)->count();

         return view('livewire.admin.dashboard', [
            'totalCustomers' => $total_customer,
            'totalAdmin' => $total_admin,
         ])->layout('layouts.admin.main',['title' => 'Admin Dashboard']);
    }
}
