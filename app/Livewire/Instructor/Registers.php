<?php

namespace App\Livewire\Instructor;

use Livewire\Component;
use Illuminate\Support\Facades\Hash;
use App\Models\Instructor;
use Illuminate\Support\Facades\Auth;

class Registers extends Component
{
    public $name, $email, $password, $password_confirmation;

    // New property for the checkbox
    public $subscribe_to_promotions = false;
    public $breadcrumbs = [];
    // Constructor livewire loaded
    public function mount()
    {
        // Define your breadcrumbs here dynamically
        $this->breadcrumbs = [
            ['label' => 'Home', 'url' => url('/')],
            ['label' => 'Instructor Register', 'url' => null],
        ];
    }
    public function render()
    {
        return view('livewire.instructor.registers')
        ->layout('layouts.instructor.main',['title' => 'Instructor Register']);
    }

    // For Instructor Register
    public function register()
    {
        $this->validate([
            'name' => 'required|min:3',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8|confirmed',
            'subscribe_to_promotions' => 'boolean', 
        ]);

        $instructor = Instructor::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make($this->password),
            'role_id' => 2, // For Instructor
            'status' => Instructor::STATUS_PENDING, // For pending or approved
            'subscribe_to_promotions' => $this->subscribe_to_promotions
       ]);

    //    dd($instructor);
        
        // dd($user);

       Auth::guard('instructor')->login($instructor);

       session()->flash('success', 'Your instructor application has been submitted!');
       return redirect()->route('instructor.pending');
    }
}
