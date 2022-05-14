<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\URL;

class TrainerEmail extends Mailable
{
    use Queueable, SerializesModels;

    protected $password;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($password)
    {
        $this->password = $password;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
//        $url = Url::temporarySignedRoute('company.send.email', now()->addHours(24), ['id'=>$this->id]);

        return $this->markdown('emails.trainer.generate-password', ['password' => $this->password]);
    }
}
