<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OtpEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $otp_code;

    public function __construct($user, $otp_code)
    {
        $this->user = $user;
        $this->otp_code = $otp_code;
    }

    public function build()
    {
        return $this->from(env('MAIL_FROM_ADDRESS'))
            ->subject('Your OTP Code')
            ->markdown('mail.otp')
            ->with([
                'user' => $this->user,
                'otp_code' => $this->otp_code
            ]);
    }
}
