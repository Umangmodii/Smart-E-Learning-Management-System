<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use App\Models\User;

class AccountSettings extends Component
{
    public $email,$password,$password_confirmation;
    public function mount()
    {
        $this->email = auth()->user()->email;
    }

    public function render()
    {
        return view('livewire.account-settings')
            ->layout('layouts.app', ['title' => 'Account Settings']);
    }

    public function updateAccount()
    {
        $this->validate([
            'email' => 'required|email|unique:users,email,' . auth()->id(),
            'password' => ['required', 'confirmed', Password::min(8)],
        ]);

        $user = auth()->user();
        $user->update([
            'email' => $this->email,
            'password' => Hash::make($this->password),
        ]);

        $this->reset(['password', 'password_confirmation']);
        session()->flash('success', 'Security updated successfully!');

    }
}