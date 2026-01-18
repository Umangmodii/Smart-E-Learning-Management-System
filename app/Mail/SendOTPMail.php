<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendOTPMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * The OTP code to show in the email view.
     *
     * @var string
     */
    public $otp;

    public function __construct(string $otp)
    {
        $this->otp = $otp;
    }

    public function build(){
        return $this->subject('Your One Time Password (OTP)')
                    ->view('emails.send_otp');
    }
}
