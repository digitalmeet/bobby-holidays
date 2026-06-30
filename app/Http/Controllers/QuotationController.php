<?php

namespace App\Http\Controllers;

use App\Models\Quotation;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class QuotationController extends Controller
{
    /**
     * Public quotation view page.
     */
    public function show(string $publicId)
    {
        $quotation = Quotation::where('public_id', $publicId)
            ->with(['items' => fn ($q) => $q->orderBy('sort_order'), 'sections'])
            ->firstOrFail();

        // Track view
        if (!request()->is('admin/*')) {
            $quotation->increment('view_count');

            if (!$quotation->viewed_at) {
                $quotation->update([
                    'viewed_at' => now(),
                    'status' => $quotation->status === 'sent' ? 'viewed' : $quotation->status,
                ]);

                $quotation->histories()->create([
                    'event' => 'viewed',
                    'old_status' => 'sent',
                    'new_status' => 'viewed',
                    'created_at' => now(),
                ]);
            }
        }

        return view('quotations.public', compact('quotation'));
    }

    /**
     * Download quotation as PDF.
     */
    public function downloadPdf(string $publicId)
    {
        $quotation = Quotation::where('public_id', $publicId)
            ->with(['items' => fn ($q) => $q->orderBy('sort_order'), 'sections'])
            ->firstOrFail();

        $pdf = Pdf::loadView('quotations.pdf', compact('quotation'));

        $filename = 'UniWorld-Quote-' . $quotation->public_id . '-v' . $quotation->version . '.pdf';

        return $pdf->download($filename);
    }

    /**
     * Client accepts quotation from public page.
     */
    public function accept(string $publicId, Request $request)
    {
        $quotation = Quotation::where('public_id', $publicId)
            ->whereIn('status', ['sent', 'viewed'])
            ->firstOrFail();

        $oldStatus = $quotation->status;
        $quotation->update([
            'status' => 'accepted',
            'accepted_at' => now(),
        ]);

        $quotation->histories()->create([
            'event' => 'accepted',
            'old_status' => $oldStatus,
            'new_status' => 'accepted',
            'notes' => 'Accepted by client via public link.',
            'created_at' => now(),
        ]);

        // Update linked enquiry
        if ($quotation->enquiry_id) {
            $quotation->enquiry->update(['status' => 'converted']);
        }

        return redirect()->back()->with('success', 'Quotation accepted successfully! Our team will contact you shortly.');
    }

    /**
     * Client rejects quotation from public page.
     */
    public function reject(string $publicId, Request $request)
    {
        $request->validate([
            'rejection_reason' => 'nullable|string|max:500',
        ]);

        $quotation = Quotation::where('public_id', $publicId)
            ->whereIn('status', ['sent', 'viewed'])
            ->firstOrFail();

        $oldStatus = $quotation->status;
        $quotation->update([
            'status' => 'rejected',
            'rejected_at' => now(),
            'rejection_reason' => $request->rejection_reason,
        ]);

        $quotation->histories()->create([
            'event' => 'rejected',
            'old_status' => $oldStatus,
            'new_status' => 'rejected',
            'notes' => $request->rejection_reason ?? 'Rejected by client via public link.',
            'created_at' => now(),
        ]);

        return redirect()->back()->with('success', 'Thank you for your feedback. We will get back to you with alternatives.');
    }
}
