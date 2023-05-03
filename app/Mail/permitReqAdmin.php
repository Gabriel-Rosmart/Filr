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

    protected $user;
    protected $perm_date;
    protected $uuid;
    protected $fileName;
    protected $email;
    protected $extension;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(object $user, string $perm_date, string $uuid,  string $fileName, string $extension)
    {
        $this->user = $user;
        $this->perm_date = $perm_date;
        $this->uuid = $uuid;
        $this->fileName = $fileName;
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
            subject: implode(['Nuevo Permiso Solicitado - ', $this->user->name]),
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
            view: 'email.permitreqAdmin',
            with: [
                'name' => $this->user->name,
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
        //dd($this);
        return [
            Attachment::fromPath(storage_path('app/permitDocs/' . $this->uuid . '.' . $this->extension))
                ->as(str_replace(' ', '_', $this->user->name) . '_' . str_replace('-', '', $this->perm_date) . '-permit_justification.' . $this->extension),
            Attachment::fromPath(storage_path('app/'. $this->fileName))
                ->as(str_replace(' ', '_', $this->user->name) . '_' . str_replace('-', '', $this->perm_date) . '-permit_request.pdf'),
        ];
    }
}
