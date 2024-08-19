<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Support\Facades\Storage;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $data;
    public  function __construct($data)
    {
        $this->data = $data;
    }
    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            from: new Address('aflahnabil01@gmail.com', 'Aflah'),
            subject: 'Kirim Email',
        );
    }

    /**
     * Get the message content definition.
     */
    // public function content(): Content
    // {
    //     return new Content(
    //         view: 'dashboard.kirim.index',
    //     );
    // }
    public function build()
    {
        $email = $this->subject($this->data['subject'])
            ->from($this->data['sender_email'])
            ->view('dashboard.kirim.index')
            ->with('data', $this->data);

        // Melampirkan file jika ada
        if (!empty($this->data['attachment'])) {
            $email->attach(Storage::path($this->data['attachment']));
        }

        return $email;
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
