<x-filament-panels::page>
    {{-- Summary Cards --}}
    <div class="grid grid-cols-2 gap-4 lg:grid-cols-4">
        <x-filament::section>
            <p class="text-xs font-medium text-gray-500">Upcoming (30 days)</p>
            <p class="text-2xl font-bold text-primary-600">{{ $upcomingCount }}</p>
        </x-filament::section>
        <x-filament::section>
            <p class="text-xs font-medium text-gray-500">Payment Overdue</p>
            <p class="text-2xl font-bold text-danger-600">{{ $overduePayments }}</p>
        </x-filament::section>
        <x-filament::section>
            <p class="text-xs font-medium text-gray-500">Total Active</p>
            <p class="text-2xl font-bold text-success-600">{{ ($statusCounts['confirmed'] ?? 0) + ($statusCounts['partial_paid'] ?? 0) + ($statusCounts['fully_paid'] ?? 0) }}</p>
        </x-filament::section>
        <x-filament::section>
            <p class="text-xs font-medium text-gray-500">Completed</p>
            <p class="text-2xl font-bold text-gray-600">{{ $statusCounts['completed'] ?? 0 }}</p>
        </x-filament::section>
    </div>

    {{-- Status Distribution --}}
    <x-filament::section heading="Booking Status Distribution">
        @php
            $total = array_sum($statusCounts) ?: 1;
            $sColors = ['confirmed' => 'info', 'partial_paid' => 'warning', 'fully_paid' => 'success', 'completed' => 'success', 'cancelled' => 'danger', 'refunded' => 'gray'];
        @endphp
        <div class="space-y-3">
            @foreach($statusCounts as $status => $count)
                <div>
                    <div class="mb-1 flex items-center justify-between">
                        <span class="text-sm font-medium capitalize text-gray-700 dark:text-gray-300">{{ str_replace('_', ' ', $status) }}</span>
                        <span class="text-sm font-bold">{{ $count }} ({{ round(($count / $total) * 100) }}%)</span>
                    </div>
                    <div class="h-3 w-full overflow-hidden rounded-full bg-gray-100 dark:bg-white/10">
                        <div class="h-3 rounded-full bg-{{ $sColors[$status] ?? 'gray' }}-500" style="width: {{ round(($count / $total) * 100) }}%"></div>
                    </div>
                </div>
            @endforeach
        </div>
    </x-filament::section>

    {{-- Monthly Bookings --}}
    <x-filament::section heading="Monthly Bookings" description="Last 6 months">
        <div class="overflow-x-auto">
            <table class="fi-ta-table w-full table-auto divide-y divide-gray-200 dark:divide-white/5">
                <thead>
                    <tr>
                        <th class="px-3 py-3 text-left text-sm font-semibold text-gray-950 dark:text-white">Month</th>
                        <th class="px-3 py-3 text-center text-sm font-semibold text-gray-950 dark:text-white">Bookings</th>
                        <th class="px-3 py-3 text-center text-sm font-semibold text-gray-950 dark:text-white">Cancelled</th>
                        <th class="px-3 py-3 text-right text-sm font-semibold text-gray-950 dark:text-white">Value</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 dark:divide-white/5">
                    @foreach($monthlyBookings as $row)
                        <tr>
                            <td class="px-3 py-3 text-sm font-medium text-gray-950 dark:text-white">{{ $row['month'] }}</td>
                            <td class="px-3 py-3 text-sm text-center">
                                <x-filament::badge color="primary" size="sm">{{ $row['total'] }}</x-filament::badge>
                            </td>
                            <td class="px-3 py-3 text-sm text-center">
                                @if($row['cancelled'] > 0)
                                    <x-filament::badge color="danger" size="sm">{{ $row['cancelled'] }}</x-filament::badge>
                                @else
                                    <span class="text-gray-400">0</span>
                                @endif
                            </td>
                            <td class="px-3 py-3 text-sm text-right font-semibold">₹{{ number_format($row['value']) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </x-filament::section>
</x-filament-panels::page>
