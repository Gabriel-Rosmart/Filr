<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Auth;

class permitReqUser extends Mailable
{
    use Queueable, SerializesModels;

    protected $perm_date;
    protected $uuid;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(string $perm_date, string $uuid)
    {
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
            subject: 'Solictud de permiso realizada',
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
            view: 'email.permitreqUser',
            with: [
                'perm_date' => $this->perm_date,
                'uuid' => $this->uuid,
                'route' => $_SERVER['HTTP_HOST'],
            ],
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array
     */
    public function attachments()
    {
        if (is_file(storage_path('app/permits/' . auth::user()->id . '/permiso_' . $this->uuid . '.pdf')))
        {
            return [
                Attachment::fromPath(storage_path('app/permits/' . auth::user()->id . '/permiso_' . $this->uuid . '.pdf'))
            ];
        }
        else
        {
            return [];
        }
    }
}
