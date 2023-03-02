<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Auth;

class permitReqAdmin extends Mailable
{
    use Queueable, SerializesModels;

    protected $name;
    protected $perm_date;
    protected $uuid;
    protected $email;
    protected $extension;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(string $name, string $perm_date, string $uuid,  string $extension)
    {
        $this->name = $name;
        $this->perm_date = $perm_date;
        $this->uuid = $uuid;
        $this->extension = $extension;
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        return new Envelope(
            subject: implode(['Nuevo Permiso Solicitado - ', $this->name]),
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
                'uuid' => $this->uuid,
                'route' => $_SERVER['HTTP_HOST'],
                'id' => Auth::user()->id,
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
            Attachment::fromPath(storage_path('app/permitDocs/' . $this->uuid . '.' . $this->extension))
                ->as(str_replace(' ', '_', $this->name) . '_' . str_replace('-', '', $this->perm_date) . '.' . $this->extension)
        ];
    }
}
