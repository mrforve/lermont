<?php
namespace App\Mail;

use App\Models\ContactRequest;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;

class SiteContactRequestMail extends Mailable
{
    public function __construct(public ContactRequest $contactRequest) {}
    public function envelope(): Envelope
    {
        $reply = $this->contactRequest->email;
        return new Envelope(
            from: new Address(config('site-requests.from'), 'Отель Лермонт — заявки сайта'),
            replyTo: $reply ? [new Address($reply)] : [],
            subject: '[Лермонт] Новая заявка №' . $this->contactRequest->id,
        );
    }
    public function content(): Content { return new Content(text: 'emails.contact-request'); }
}
