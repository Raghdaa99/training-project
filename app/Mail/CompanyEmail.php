<?php

namespace App\Mail;

use Hashids\Hashids;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\URL;

class CompanyEmail extends Mailable
{
    use Queueable, SerializesModels;

    protected $id;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($id)
    {
        $this->id = $id;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
//        $hashids = new Hashids();
//        $id = $hashids->encodeHex($this->id);
        $url = Url::temporarySignedRoute('company.send.email', now()->addHours(1000), ['id'=>$this->id]);
        return $this->markdown('emails.company.show_email',['url'=>$url]);
    }
}
