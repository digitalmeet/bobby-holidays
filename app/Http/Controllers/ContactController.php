<?php

namespace App\Http\Controllers;

use App\Models\Destination;
use App\Models\Enquiry;
use App\Models\User;
use Filament\Notifications\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class ContactController extends Controller
{
    public function show(Request $request)
    {
        $brief = [];

        if ($request->filled('brief')) {
            try {
                $brief = json_decode(Crypt::decryptString((string) $request->query('brief')), true, 512, JSON_THROW_ON_ERROR);
                $brief = array_intersect_key($brief, array_flip(['name', 'email', 'phone', 'destination', 'travel_date', 'adults', 'budget_range']));
            } catch (\Throwable) {
                // A stale or altered link should simply open a blank contact form.
            }
        }

        return view('frontend.contact', compact('brief'));
    }

    /** Securely hand off the homepage trip planner to the contact form. */
    public function planTrip(Request $request)
    {
        $brief = $request->validate([
            'name' => 'nullable|string|min:2|max:255',
            'email' => 'nullable|email|max:255',
            'phone' => 'nullable|string|min:10|max:20',
            'destination' => 'nullable|string|max:255',
            'travel_date' => 'nullable|date',
            'adults' => 'nullable|integer|min:1|max:50',
            'budget_range' => 'nullable|string|max:100',
        ]);

        return redirect()->route('frontend.contact', ['brief' => encrypted_query($brief)]);
    }

    public function submit(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|min:2',
            'phone' => 'required|string|max:20|min:10',
            'email' => 'nullable|email|max:255',
            'destination' => 'nullable|string|max:255',
            'travel_date' => 'nullable|date',
            'adults' => 'nullable|integer|min:1|max:50',
            'children' => 'nullable|integer|min:0|max:20',
            'message' => 'nullable|string|max:2000',
            'source_page' => 'nullable|string|max:255',
            'budget_range' => 'nullable|string|max:100',
            'privacy_acceptance' => 'required|accepted',
        ]);

        // Try to match destination
        $destination = null;
        if (!empty($validated['destination'])) {
            $sanitized = str_replace(['%', '_'], ['\%', '\_'], $validated['destination']);
            $destination = Destination::where('name', 'like', "%{$sanitized}%")->first();
        }

        // Determine source context
        $sourcePage = $validated['source_page'] ?? null;
        $isSticky = $sourcePage && empty($validated['message']);

        $enquiry = Enquiry::create([
            'name' => $validated['name'],
            'phone' => $validated['phone'],
            'email' => $validated['email'] ?? null,
            'destination_id' => $destination?->id,
            'travel_date' => $validated['travel_date'] ?? null,
            'adults' => $validated['adults'] ?? 1,
            'children' => $validated['children'] ?? 0,
            'message' => $validated['message'] ?? ($sourcePage ? "Enquiry from: /{$sourcePage}" : null),
            'budget_range' => $validated['budget_range'] ?? null,
            'status' => 'new',
            'source' => 'website',
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
            'privacy_accepted_at' => now(),
            'privacy_policy_version' => config('legal.privacy_policy_version'),
            'consent_source' => $isSticky ? 'sticky-enquiry' : 'contact-form',
            'internal_notes' => $isSticky ? "Quick enquiry from sticky bar on /{$sourcePage}" : null,
        ]);

        // Repeat client notification
        $repeatCount = Enquiry::where('phone', $validated['phone'])->count();
        if ($repeatCount > 1) {
            $admins = User::whereHas('roles', fn ($q) => $q->whereIn('name', ['super_admin', 'sales']))->get();
            if ($admins->isNotEmpty()) {
                Notification::make()
                    ->title('Repeat Client')
                    ->body("{$validated['name']} ({$validated['phone']}) — {$repeatCount} total enquiries.")
                    ->warning()
                    ->sendToDatabase($admins);
            }
        }

        // Return JSON for AJAX or redirect for normal form
        if ($request->ajax() || $request->wantsJson() || $request->header('X-Requested-With') === 'XMLHttpRequest') {
            return response()->json([
                'success' => true,
                'message' => 'Enquiry submitted successfully.',
                'enquiry_id' => $enquiry->id,
            ]);
        }

        return redirect()->back()->with('success', 'Thank you! Your enquiry has been submitted. We will contact you shortly.');
    }
}
