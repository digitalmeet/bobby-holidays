<?php

namespace App\Mail;

use App\Models\Quotation;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class QuotationSent extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public Quotation $quotation) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: setting('company_name', 'UniWorld Holidays') . ' — Your Travel Quotation',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.quotation-sent',
            with: [
                'quotation' => $this->quotation,
                'publicUrl' => url("/quote/{$this->quotation->public_id}"),
            ],
        );
    }
}
