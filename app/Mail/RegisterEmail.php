<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Crypt;

class RegisterEmail extends Mailable
{
    use Queueable, SerializesModels;

    private $userModel;
    private $coupon_code;
    private $message;
    private $dynamic_title;
    private $dynamic_value;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($userModel, $coupon_code = null)
    {
        $this->userModel = $userModel;
        $this->coupon_code = $coupon_code;  // Pass coupon code to the template
        $this->message = 'Welcome to the ' . env('APP_NAME') . ', you are warmly welcomed into our family.';
        $this->dynamic_title = 'Password';
        $this->dynamic_value = Crypt::decrypt($this->userModel->enc_password);

        if ($coupon_code !== null) {
            $this->dynamic_title = 'Coupon Code';
            $this->dynamic_value = $coupon_code;
            $this->message = 'Hello ' . $this->userModel->name . ', you got the 100% value back of your purchased kit as a coupon code, here it is: ';
        }
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from(env('MAIL_FROM_ADDRESS'))
            ->subject('Welcome To ' . env('APP_NAME'))
            ->markdown('mail.register')
            ->with([
                'userModel' => $this->userModel,
                'message' => $this->message,
                'dynamic_title' => $this->dynamic_title,
                'dynamic_value' => $this->dynamic_value,
                'coupon_code' => $this->coupon_code, // Ensure this is available in the view
            ]);
    }
}
