<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendStaffWelcomeEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $user_email;

    public $password;

    public $user_name;

    /**
     * Create a new message instance.
     */
    public function __construct($user_email, $password, $user_name)
    {
        $this->user_email = $user_email;
        $this->password = $password;
        $this->user_name = $user_name;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $baseUrl = config('app.url');
        $baseUrl = str_replace(['http://', 'https://'], '', $baseUrl);
        $from = env('MAIL_FROM_ADDRESS');

        return $this->from($from, config('app.name'))
            ->markdown('emails.welcome-email')
            ->subject('Welcome to '.config('app.name'));
    }
}
