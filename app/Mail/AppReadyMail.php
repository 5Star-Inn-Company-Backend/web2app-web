<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AppReadyMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $fileurl;
    public $reference;
    public function __construct($reference, $fileurl)
    {
        $this->reference=$reference;
        $this->fileurl=$fileurl;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.app_ready')->subject("App is Ready!! ".$this->reference)->attach($this->fileurl);
    }
}
