<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\DB;

class Register extends Component
{
    public $breadcrumbs = [];
    // Constructor livewire loaded
    public function mount()
    {
        // Define your breadcrumbs here dynamically
        $this->breadcrumbs = [
            ['label' => 'Home', 'url' => url('/')],
            ['label' => 'Register', 'url' => null],
        ];
    }
    public $name, $email, $password, $password_confirmation;
    protected $rules = [
        'name' => 'required|min:3',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|min:8|confirmed',
    ];

    public function render()
    {
        return view('livewire.register')
        ->layout('layouts.app',['title' => 'Register']);
    }

    public function register(){
         $this->validate();
           
         try{
        // Create User
        $user = User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => bcrypt($this->password),
        ]);

        // Default Role: Student
        $user->roles()->attach(
            Role::where('name','student')->first()
        );
        
        auth()->login($user);

            session()->flash('success','User Registered Successfully!');
            return redirect()->route('login');
        }

        catch(Exception $e){
            session()->flash('error','Registration Failed: '.$e->getMessage());
        }
    }
}
