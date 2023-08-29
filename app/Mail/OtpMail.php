<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class OtpMail extends Mailable
{
    use Queueable, SerializesModels;
    public $otpmail;

    /**
     * Create a new message instance.
     */
    public function __construct($otpmail)
    {
        $this->otpmail = $otpmail;

    }


    /**
     * Get the message envelope.
     */

    public function build()
    {
        return $this->subject('Mail from Mini_CRM')
            ->view('emails.myOtpMail');
    }
//    public function envelope(): Envelope
//    {
//        return new Envelope(
//            subject: 'Otp Mail',
//        );
//    }

    /**
     * Get the message content definition.
     */
//    public function content(): Content
//    {
//        return new Content(
//            view: 'view.name',
//        );
//    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
//    public function attachments(): array
//    {
//        return [];
//    }
}
