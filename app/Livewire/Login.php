<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\UserOtp;
use App\Mail\SendOTPMail;
use Illuminate\Support\Facades\Mail;

class Login extends Component
{
    public $email, $password;
    public $rules = [
        'email' => 'required|email',
        'password' => 'required',
    ];
    public $breadcrumbs = [];
    // Constructor livewire loaded
    public function mount()
    {
        // Define your breadcrumbs here dynamically
        $this->breadcrumbs = [
            ['label' => 'Home', 'url' => url('/')],
            ['label' => 'Login', 'url' => null],
        ];
    }
    public function render()
    {
       return view('livewire.login')
            ->layout('layouts.app', ['title' => 'Login']);
    }
    public function login()
    {
        $this->validate();

        if (!auth()->attempt([
                'email' => $this->email, 
                'password' => $this->password
            ]))
            {
                session()->flash('error', 'Invalid Login credentials! Please try again.');
                return;
            }

            $user = auth()->user();

            // Check if OTP is enabled for the user
            $otp_code = rand(10000, 999999);

            UserOtp::updateOrCreate(
                ['user_id' => $user->id],
                ['otp_code' => $otp_code, 'expires_at' => now()->addMinutes(2)]
            );

            Mail::to($user->email)->send(new SendOTPMail($otp_code));

            auth()->logout();

            session([
                'otp_user_id' => $user->id,
                'otp_user_email' => $user->email,
            ]);
            return redirect()->route('otp-verify');
    }
}