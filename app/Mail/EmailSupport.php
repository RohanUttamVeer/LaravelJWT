<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class EmailSupport extends Mailable
{
    use Queueable, SerializesModels;


    public $subject;
    public $mail_message;
    public $otp;

    /**
     * Create a new message instance.
     */
    public function __construct($subject, $mail_message, $otp)
    {
        $this->mail_message = $mail_message;
        $this->$subject = $subject;
        $this->$otp = $otp;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            from: new Address('thetotuniverse@gmail.com', 'Tale of Tails'),
            replyTo: [
                new Address('thetotuniverse@gmail.com', 'Tale of Tails'),
            ],
            subject: $this->subject,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'mail-template.otp-mail',
            with: [
                'mail_message' => $this->mail_message,
                'subject' => $this->subject,
                'otp' => $this->otp,
            ],
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
