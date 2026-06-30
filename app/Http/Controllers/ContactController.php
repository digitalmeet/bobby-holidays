<?php

namespace App\Http\Controllers;

use App\Models\Destination;
use App\Models\Enquiry;
use App\Models\User;
use Filament\Notifications\Notification;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function show()
    {
        return view('frontend.contact');
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
        ]);

        // Try to match destination
        $destination = null;
        if (!empty($validated['destination'])) {
            $destination = Destination::where('name', 'like', "%{$validated['destination']}%")->first();
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
            'status' => 'new',
            'source' => 'website',
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
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
