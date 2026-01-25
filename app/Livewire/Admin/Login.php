<?php

namespace App\Livewire\Admin;
use App\Rules\ReCaptcha;
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
            // 'g-recaptcha-response' => ['required', new ReCaptcha],
        ]);

        if (auth()->attempt($credentials)) {
            // Check if the user is actually an admin
            if (auth()->user()->isSuperAdmin()) {
                session()->flash('success', 'Admin login successfully.');
                // return redirect()->route('admin.dashboard');
                return redirect()->route('admin.dashboard');
            }

            // MISTAKE PREVENTER: If they are a student, log them out immediately!
            auth()->logout();
            session()->flash('error', 'Access Denied: These credentials do not have Admin privileges.');
            return redirect()->route('admin.admin_login');
        }

        session()->flash('error', 'Invalid login details.');
    }
}
