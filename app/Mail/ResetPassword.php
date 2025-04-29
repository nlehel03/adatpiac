<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ResetPassword extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $resetUrl;

    public function __construct(User $user, $token)
    {
        $this->user = $user;
        $this->resetUrl = route('password.reset', ['email' => $user->email, 'token' => $token]);
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Jelszó visszaállítás - Adatpiac',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.reset-password',
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
