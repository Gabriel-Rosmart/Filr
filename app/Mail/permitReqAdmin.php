<?php

namespace App\Mail;

use App\Models\Permit;
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

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(object $user, string $perm_date, string $uuid)
    {
        $this->user = $user;
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

        $justification = Permit::where('uuid', $this->uuid)->first()->file;
        if ($justification != null
            && is_file(storage_path('app/justifications/' . Auth::user()->id . '/' . $justification))
            && is_file(storage_path('app/permits/' . auth::user()->id . '/permiso_' . $this->uuid . '.pdf')))
        {
            return [
                Attachment::fromPath(storage_path('app/justifications/' . Auth::user()->id . '/' . Permit::where('uuid', $this->uuid)->first()->file)),
                Attachment::fromPath(storage_path('app/permits/' . Auth::user()->id . '/permiso_' . $this->uuid . '.pdf'))
            ];
        }
        else if (is_file(storage_path('app/permits/' . auth::user()->id . '/permiso_' . $this->uuid . '.pdf')))
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
