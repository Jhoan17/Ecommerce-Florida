<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Security\User;


class ForgotPassword extends Mailable
{
    use Queueable, SerializesModels;

    public $user_id;
    public $passwordNew;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user_id, $passwordNew)
    {
        $this->user_id = $user_id;
        $this->passwordNew = $passwordNew;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $user = User::find($this->user_id);
        return $this->view('mails.forgot-password', compact("user"));
    }
}
