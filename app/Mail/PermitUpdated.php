<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class PermitUpdated extends Mailable
{
    use Queueable, SerializesModels;

    protected $user;
    protected $uuid;
    protected $status;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(string $user, string $uuid, string $status)
    {
        $this->user = $user;
        $this->uuid = $uuid;
        $this->status = $status;
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        return new Envelope(
            subject: 'Permit Updated',
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
            view: 'email.permit',
            with: [
                'name' => $this->user,
                'uuid' => $this->uuid,
                'status' => trans('mail.' . $this->status),
                'route' => $_SERVER['HTTP_HOST'],
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
        return [];
    }
}
