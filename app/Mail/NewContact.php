<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class NewContact extends Mailable
{
    use Queueable, SerializesModels;
    // questa variabile raccoglierà i dati del cliente
    public $lead;

    /**
     * Create a new message instance.
     */
    public function __construct($_lead)
    {
        //
        // associamo la variabile $lead all'attributo della funzione
        $this->lead = $_lead
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            // aggiungo questa dicitura che condividerà i dati del cliente per l'intestazione
            replyTo: $this->lead->email,
            subject: 'New Contact',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'mails.new-contact-mail',
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
