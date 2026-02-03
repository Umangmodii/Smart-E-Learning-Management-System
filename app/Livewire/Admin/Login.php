<?php

namespace App\Livewire\Admin;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Login extends Component
{
    public $email;
    public $password;
    public $breadcrumbs = [];
    // Constructor livewire loaded
    public function mount()
    {
        // Define your breadcrumbs here dynamically
        $this->breadcrumbs = [
            ['label' => 'Home', 'url' => url('/')],
            ['label' => 'Admin Login', 'url' => null],
        ];
    }
    public function render()
    {
        return view('livewire.admin.login')
        ->layout('layouts.admin.admin_login',['title' => 'Admin Login']);
    }

  // app/Livewire/Admin/Login.php
    public function login()
    {
        $credentials = $this->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

       if (Auth::guard('admin')->attempt($credentials)) {
            
            // 2. Regenerate session for the admin guard
            request()->session()->regenerate();
            
            session()->flash('success', 'Admin login successfully.');
            return redirect()->route('admin.dashboard');
        }

        session()->flash('error', 'Invalid login details.');
    }
}
