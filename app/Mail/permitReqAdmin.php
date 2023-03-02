<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class permitReqAdmin extends Mailable
{
    use Queueable, SerializesModels;

    protected $name;
    protected $perm_date;
    protected $uuid;
    protected $email;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(string $name, string $perm_date, string $uuid)
    {
        $this->name = $name;
        $this->perm_date = $perm_date;
        $this->uuid = $uuid;
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        return new Envelope(
            subject: 'Nuevo permiso solicitado',
        );
    }

    /**
     * Get the message content definition.
     *
     * @return \Illuminate\Mail\Mailables\Content
     */
    public function content()
    {
        return new Content(
            view: 'email.permitReqAdmin',
            with: [
                'name' => $this->name,
                'perm_date' => $this->perm_date,    
                'uuid' => $this->uuid
            ]
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array
     */
    public function attachments()
    {
        return [
            Attachment::fromPath(storage_path('app/permitDocs/' . $this->uuid . '.pdf'))
                ->as('justificante.pdf')
                ->withMime('application/pdf'),
        ];
    }
}
