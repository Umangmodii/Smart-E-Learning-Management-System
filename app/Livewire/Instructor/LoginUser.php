<?php

namespace App\Livewire\Instructor;

use Livewire\Component;

class LoginUser extends Component
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
            ['label' => 'Instructor Login', 'url' => null],
        ];
    }
    public function render()
    {
        return view('livewire.instructor.login')
        ->layout('layouts.instructor.main',['title' => 'Instructor Login']);
    }

    public function login()
    {
        $this->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Use the 'instructor' guard from your config/auth.php
        if (auth('instructor')->attempt(['email' => $this->email, 'password' => $this->password])) {
            
            $instructor = auth('instructor')->user();

            // Security Check: Only allow if approved
            if ($instructor->status != 1) {
                auth('instructor')->logout();
                return session()->flash('error', 'Your account is still pending approval.');
            }

            // Industrial Redirect
            return redirect()->intended(route('instructor.dashboard'));
        }

        return session()->flash('error', 'Invalid credentials.');
    }
}
