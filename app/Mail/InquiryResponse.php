<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class InquiryResponse extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $company = session('company');
        $brand = optional($company)->abrv ?: optional($company)->name ?: 'us';
        $fromName = optional($company)->name ?: optional($company)->abrv;

        $message = $this->subject('A message from '.$brand)->view('mail.inquiry_response');
        if ($fromName) {
            $message->from(config('mail.from.address'), $fromName);
        }

        return $message;
    }
}
