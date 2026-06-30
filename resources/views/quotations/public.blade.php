<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $quotation->title }} — UniWorld Holidays</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>tailwind.config = { theme: { extend: { colors: { brand: '#064f68' } } } }</script>
</head>
<body class="bg-gray-50 min-h-screen">
    {{-- Header --}}
    <header class="bg-brand text-white py-6">
        <div class="max-w-4xl mx-auto px-4">
            <h1 class="text-2xl font-bold">UniWorld Holidays</h1>
            <p class="text-sm opacity-80">Your Journey, Our Passion</p>
        </div>
    </header>

    <main class="max-w-4xl mx-auto px-4 py-8">
        {{-- Flash Messages --}}
        @if(session('success'))
            <div class="bg-green-50 border border-green-200 text-green-800 px-4 py-3 rounded-lg mb-6">
                {{ session('success') }}
            </div>
        @endif

        {{-- Title & Meta --}}
        <div class="mb-6">
            <h2 class="text-2xl font-bold text-gray-900">{{ $quotation->title }}</h2>
            <p class="text-sm text-gray-500 mt-1">
                Quote #{{ $quotation->public_id }} &middot; Version {{ $quotation->version }}
                @if($quotation->validity_date)
                    &middot; Valid until {{ $quotation->validity_date->format('d M Y') }}
                @endif
            </p>
        </div>

        {{-- Status Badge --}}
        @if($quotation->status === 'accepted')
            <div class="bg-green-50 border border-green-200 text-green-800 px-4 py-3 rounded-lg mb-6">
                ✅ This quotation has been accepted on {{ $quotation->accepted_at->format('d M Y') }}.
            </div>
        @elseif($quotation->status === 'rejected')
            <div class="bg-red-50 border border-red-200 text-red-800 px-4 py-3 rounded-lg mb-6">
                ❌ This quotation was declined.
            </div>
        @elseif($quotation->status === 'expired' || ($quotation->validity_date && $quotation->validity_date->isPast()))
            <div class="bg-yellow-50 border border-yellow-200 text-yellow-800 px-4 py-3 rounded-lg mb-6">
                ⏰ This quotation has expired. Please contact us for an updated quote.
            </div>
        @endif

        {{-- Trip Details Card --}}
        <div class="bg-white rounded-xl shadow-sm border p-6 mb-6">
            <h3 class="font-semibold text-gray-900 mb-4">Trip Details</h3>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 text-sm">
                <div>
                    <p class="text-gray-500">Travel Date</p>
                    <p class="font-medium">{{ $quotation->travel_date?->format('d M Y') ?? 'TBD' }}</p>
                </div>
                @if($quotation->return_date)
                <div>
                    <p class="text-gray-500">Return Date</p>
                    <p class="font-medium">{{ $quotation->return_date->format('d M Y') }}</p>
                </div>
                @endif
                <div>
                    <p class="text-gray-500">Travellers</p>
                    <p class="font-medium">{{ $quotation->adults }} Adult(s){{ $quotation->children ? ", {$quotation->children} Child(ren)" : '' }}</p>
                </div>
                <div>
                    <p class="text-gray-500">Prepared For</p>
                    <p class="font-medium">{{ $quotation->client_name }}</p>
                </div>
            </div>
        </div>

        {{-- Personalised Message --}}
        @if($quotation->personalised_message)
            <div class="bg-brand/5 border-l-4 border-brand p-4 rounded-r-lg mb-6 italic text-gray-700">
                {{ $quotation->personalised_message }}
            </div>
        @endif

        {{-- Items Table --}}
        @if($quotation->items->count())
            <div class="bg-white rounded-xl shadow-sm border overflow-hidden mb-6">
                <table class="w-full text-sm">
                    <thead class="bg-brand text-white">
                        <tr>
                            <th class="px-4 py-3 text-left">Type</th>
                            <th class="px-4 py-3 text-left">Description</th>
                            <th class="px-4 py-3 text-center">Nights</th>
                            <th class="px-4 py-3 text-right">Amount</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @foreach($quotation->items->sortBy('sort_order') as $item)
                            <tr class="{{ $item->is_optional ? 'bg-yellow-50' : '' }}">
                                <td class="px-4 py-3">
                                    <span class="inline-block bg-gray-100 text-gray-700 text-xs px-2 py-1 rounded">{{ ucfirst($item->type) }}</span>
                                </td>
                                <td class="px-4 py-3">
                                    <p class="font-medium text-gray-900">{{ $item->title }}</p>
                                    @if($item->description)
                                        <p class="text-xs text-gray-500 mt-0.5">{{ $item->description }}</p>
                                    @endif
                                    @if($item->is_optional)
                                        <span class="text-xs text-amber-600">(Optional)</span>
                                    @endif
                                </td>
                                <td class="px-4 py-3 text-center">{{ $item->nights ?? '—' }}</td>
                                <td class="px-4 py-3 text-right font-medium">₹{{ number_format($item->total_cost, 2) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif

        {{-- Totals --}}
        <div class="bg-white rounded-xl shadow-sm border p-6 mb-6">
            <div class="max-w-xs ml-auto space-y-2 text-sm">
                <div class="flex justify-between">
                    <span class="text-gray-500">Subtotal</span>
                    <span>₹{{ number_format($quotation->subtotal_amount, 2) }}</span>
                </div>
                @if($quotation->discount_amount > 0)
                    <div class="flex justify-between text-green-600">
                        <span>Discount</span>
                        <span>- ₹{{ number_format($quotation->discount_amount, 2) }}</span>
                    </div>
                @endif
                @if($quotation->tax_amount > 0)
                    <div class="flex justify-between">
                        <span class="text-gray-500">Tax / GST</span>
                        <span>₹{{ number_format($quotation->tax_amount, 2) }}</span>
                    </div>
                @endif
                <div class="flex justify-between pt-3 border-t-2 border-brand text-lg font-bold text-brand">
                    <span>Total ({{ $quotation->currency }})</span>
                    <span>₹{{ number_format($quotation->total_amount, 2) }}</span>
                </div>
            </div>
        </div>

        {{-- Action Buttons (only if quotation is actionable) --}}
        @if(in_array($quotation->status, ['sent', 'viewed']))
            <div class="flex flex-col sm:flex-row gap-3 mb-6">
                <form action="{{ route('quotation.accept', $quotation->public_id) }}" method="POST" class="flex-1">
                    @csrf
                    <button type="submit" class="w-full bg-green-600 hover:bg-green-700 text-white font-semibold py-3 px-6 rounded-lg transition">
                        ✅ Accept Quotation
                    </button>
                </form>
                @if(setting('razorpay_enabled') === 'true')
                    <a href="{{ route('payment.page', $quotation->public_id) }}" class="flex-1 text-center bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 px-6 rounded-lg transition">
                        💳 Pay Online
                    </a>
                @endif
                <form action="{{ route('quotation.reject', $quotation->public_id) }}" method="POST" class="flex-1" onsubmit="return confirm('Are you sure you want to decline this quotation?')">
                    @csrf
                    <button type="submit" class="w-full bg-red-50 hover:bg-red-100 text-red-700 font-semibold py-3 px-6 rounded-lg border border-red-200 transition">
                        ❌ Decline
                    </button>
                </form>
                <a href="{{ route('quotation.pdf', $quotation->public_id) }}" class="flex-1 text-center bg-gray-100 hover:bg-gray-200 text-gray-700 font-semibold py-3 px-6 rounded-lg border transition" target="_blank">
                    📄 Download PDF
                </a>
            </div>
        @elseif($quotation->status === 'accepted' && setting('razorpay_enabled') === 'true')
            <div class="mb-6">
                <a href="{{ route('payment.page', $quotation->public_id) }}" class="block text-center bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 px-6 rounded-lg transition">
                    💳 Pay Online — ₹{{ number_format($quotation->total_amount, 2) }}
                </a>
            </div>
        @endif

        {{-- Terms --}}
        @if($quotation->terms_and_conditions)
            <div class="bg-white rounded-xl shadow-sm border p-6 mb-6">
                <h3 class="font-semibold text-gray-900 mb-3">Terms & Conditions</h3>
                <p class="text-sm text-gray-600 whitespace-pre-line">{{ $quotation->terms_and_conditions }}</p>
            </div>
        @endif
    </main>

    {{-- Footer --}}
    <footer class="text-center py-6 text-xs text-gray-400 border-t">
        <p>&copy; {{ date('Y') }} UniWorld Holidays. All rights reserved.</p>
        <p class="mt-1">Contact: +91-XXXXX-XXXXX | info@uniworldholidays.com</p>
    </footer>
</body>
</html>
