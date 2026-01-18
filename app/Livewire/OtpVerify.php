<?php

namespace App\Livewire;

use Livewire\Component;
use App\Mail\SendOTPMail;
use App\Models\UserOtp;
use Illuminate\Support\Facades\Mail;

class OtpVerify extends Component
{
    public $otp;
    public $rules = [
        'otp' => 'required|string|max:6',
    ];
    public function render()
    {
        return view('livewire.otp-verify')
            ->layout('layouts.app',['title' => 'OTP Verify']);
    }

    public function otp_verification(){
        $this->validate();

        $userId = session('otp_user_id');

        if (! $userId) {
            return redirect()->route('login');
        }

        $otpRecord = UserOtp::where('user_id', $userId)
            ->where('expires_at', '>', now())
            ->first();

        if (! $otpRecord || $this->otp !== $otpRecord->otp_code) {
            session()->flash('error', 'Invalid or expired OTP');
            return;
        }

        auth()->loginUsingId($userId);

        $otpRecord->delete();
        session()->forget('otp_user_id');

        return redirect()->route('dashboard');
    }
}
