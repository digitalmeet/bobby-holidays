<?php

namespace App\Mail;

use App\Models\Quotation;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class QuotationSent extends Mailable implements ShouldQueue
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
                'publicUrl' => $this->quotation->publicUrl(),
            ],
        );
    }

    public function attachments(): array
    {
        $quotation = $this->quotation->loadMissing(['items' => fn ($query) => $query->orderBy('sort_order'), 'sections']);
        $filename = 'UniWorld-Quote-' . $quotation->public_id . '-v' . $quotation->version . '.pdf';

        return [
            Attachment::fromData(
                fn (): string => Pdf::loadView('quotations.pdf', compact('quotation'))->output(),
                $filename,
            )->withMime('application/pdf'),
        ];
    }
}
