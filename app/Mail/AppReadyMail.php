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
    public $apk;
    public $aab;
    public $ios;
    public $reference;
    public function __construct($reference, $apk, $aab, $ios)
    {
        $this->reference=$reference;
        $this->apk=$apk;
        $this->ios=$ios;
        $this->aab=$aab;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.app_ready')->with(['apk' => $this->apk, 'aab' => $this->aab, 'ios' => $this->ios])->subject("App is Ready!! ".$this->reference);
    }
}
