<?php

namespace App\Livewire;

use Livewire\Component;

class Dashboard extends Component
{
    public $breadcrumbs = [];
    // Constructor livewire loaded
    public function mount()
    {
        // Define your breadcrumbs here dynamically
        $this->breadcrumbs = [
            ['label' => 'Home', 'url' => url('/')],
            ['label' => 'Dashboard', 'url' => null],
        ];
    }
    public function render()
    {
        return view('livewire.dashboard')
        ->layout('layouts.app',['title' => 'Dashboard']);
    }

    // User Logout
    public function logout()
    {
        auth()->logout();
        session()->flash('success','Logged Out Successfully');
        return redirect()->route('login');
    }
}
