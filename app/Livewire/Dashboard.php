<?php

namespace App\Livewire;

use Livewire\Component;

class Dashboard extends Component
{
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
