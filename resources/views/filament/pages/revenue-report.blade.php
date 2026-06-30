<x-filament-panels::page>
    {{-- Revenue Cards --}}
    <div class="grid grid-cols-2 gap-4 sm:grid-cols-3 lg:grid-cols-5">
        <div class="rounded-xl border border-gray-200 bg-white p-4 shadow-sm dark:border-gray-700 dark:bg-gray-800">
            <p class="text-xs font-medium uppercase tracking-wide text-gray-500 dark:text-gray-400">This Month</p>
            <p class="mt-1 text-xl font-bold text-primary-600 dark:text-primary-400">₹{{ number_format($revenueSummary['this_month']) }}</p>
        </div>
        <div class="rounded-xl border border-gray-200 bg-white p-4 shadow-sm dark:border-gray-700 dark:bg-gray-800">
            <p class="text-xs font-medium uppercase tracking-wide text-gray-500 dark:text-gray-400">This Year</p>
            <p class="mt-1 text-xl font-bold text-primary-600 dark:text-primary-400">₹{{ number_format($revenueSummary['this_year']) }}</p>
        </div>
        <div class="rounded-xl border border-gray-200 bg-white p-4 shadow-sm dark:border-gray-700 dark:bg-gray-800">
            <p class="text-xs font-medium uppercase tracking-wide text-gray-500 dark:text-gray-400">Total Bookings</p>
            <p class="mt-1 text-xl font-bold text-gray-900 dark:text-white">₹{{ number_format($revenueSummary['total_bookings_value']) }}</p>
        </div>
        <div class="rounded-xl border border-gray-200 bg-white p-4 shadow-sm dark:border-gray-700 dark:bg-gray-800">
            <p class="text-xs font-medium uppercase tracking-wide text-gray-500 dark:text-gray-400">Collected</p>
            <p class="mt-1 text-xl font-bold text-success-600 dark:text-success-400">₹{{ number_format($revenueSummary['total_collected']) }}</p>
        </div>
        <div class="rounded-xl border border-gray-200 bg-white p-4 shadow-sm dark:border-gray-700 dark:bg-gray-800">
            <p class="text-xs font-medium uppercase tracking-wide text-gray-500 dark:text-gray-400">Pending</p>
            <p class="mt-1 text-xl font-bold text-danger-600 dark:text-danger-400">₹{{ number_format($revenueSummary['total_pending']) }}</p>
        </div>
    </div>

    {{-- Monthly Revenue Table --}}
    <x-filament::section heading="Monthly Revenue" description="Last 6 months performance">
        <div class="overflow-x-auto">
            <table class="w-full table-auto divide-y divide-gray-200 text-sm dark:divide-white/5">
                <thead>
                    <tr class="bg-gray-50 dark:bg-white/5">
                        <th class="px-4 py-3 text-left font-semibold text-gray-950 dark:text-white">Month</th>
                        <th class="px-4 py-3 text-center font-semibold text-gray-950 dark:text-white">Bookings</th>
                        <th class="px-4 py-3 text-center font-semibold text-gray-950 dark:text-white">Cancelled</th>
                        <th class="px-4 py-3 text-right font-semibold text-gray-950 dark:text-white">Revenue</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 dark:divide-white/5">
                    @foreach($monthlyRevenue as $row)
                        <tr>
                            <td class="px-4 py-3 font-medium text-gray-900 dark:text-white">{{ $row['month'] }}</td>
                            <td class="px-4 py-3 text-center text-gray-600 dark:text-gray-400">{{ $row['bookings'] }}</td>
                            <td class="px-4 py-3 text-center">
                                @if($row['cancelled'] > 0)
                                    <span class="inline-flex items-center rounded-md bg-danger-50 px-2 py-1 text-xs font-medium text-danger-700 dark:bg-danger-400/10 dark:text-danger-400">{{ $row['cancelled'] }}</span>
                                @else
                                    <span class="text-gray-400">0</span>
                                @endif
                            </td>
                            <td class="px-4 py-3 text-right font-semibold text-success-600 dark:text-success-400">₹{{ number_format($row['revenue']) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </x-filament::section>

    {{-- Payment Methods --}}
    <x-filament::section heading="Payment Methods" description="This year's collection breakdown">
        <div class="overflow-x-auto">
            <table class="w-full table-auto divide-y divide-gray-200 text-sm dark:divide-white/5">
                <thead>
                    <tr class="bg-gray-50 dark:bg-white/5">
                        <th class="px-4 py-3 text-left font-semibold text-gray-950 dark:text-white">Method</th>
                        <th class="px-4 py-3 text-center font-semibold text-gray-950 dark:text-white">Transactions</th>
                        <th class="px-4 py-3 text-right font-semibold text-gray-950 dark:text-white">Amount</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 dark:divide-white/5">
                    @forelse($paymentMethods as $method)
                        <tr>
                            <td class="px-4 py-3 font-medium capitalize text-gray-900 dark:text-white">{{ str_replace('_', ' ', $method->method) }}</td>
                            <td class="px-4 py-3 text-center text-gray-600 dark:text-gray-400">{{ $method->count }}</td>
                            <td class="px-4 py-3 text-right font-semibold text-gray-900 dark:text-white">₹{{ number_format($method->total) }}</td>
                        </tr>
                    @empty
                        <tr><td colspan="3" class="px-4 py-6 text-center text-gray-500">No payment data available.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </x-filament::section>
</x-filament-panels::page>
