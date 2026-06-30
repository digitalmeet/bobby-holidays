<x-filament-panels::page>
    {{-- Enquiry Pipeline --}}
    <x-filament::section heading="Enquiry Pipeline" description="Current funnel status">
        @php
            $pipelineTotal = array_sum($pipeline) ?: 1;
            $pColors = ['new' => 'danger', 'contacted' => 'warning', 'quoted' => 'info', 'converted' => 'success', 'lost' => 'gray'];
        @endphp
        <div class="space-y-3">
            @foreach($pipeline as $status => $count)
                <div>
                    <div class="mb-1 flex items-center justify-between">
                        <span class="text-sm font-medium capitalize text-gray-700 dark:text-gray-300">{{ $status }}</span>
                        <span class="text-sm font-bold">{{ $count }}</span>
                    </div>
                    <div class="h-3 w-full overflow-hidden rounded-full bg-gray-100 dark:bg-white/10">
                        <div class="h-3 rounded-full bg-{{ $pColors[$status] ?? 'gray' }}-500" style="width: {{ round(($count / $pipelineTotal) * 100) }}%"></div>
                    </div>
                </div>
            @endforeach
        </div>
    </x-filament::section>

    <div class="grid grid-cols-1 gap-6 lg:grid-cols-2">
        {{-- Enquiry Sources --}}
        <x-filament::section heading="Sources (This Month)">
            @php $sourceLabels = ['website' => 'Website', 'whatsapp' => 'WhatsApp', 'referral' => 'Referral', 'walkin' => 'Walk-in', 'instagram' => 'Instagram', 'facebook' => 'Facebook']; @endphp
            @forelse($sources as $source => $count)
                <div class="flex items-center justify-between border-b border-gray-100 py-2 last:border-0 dark:border-white/10">
                    <span class="text-sm text-gray-700 dark:text-gray-300">{{ $sourceLabels[$source] ?? ucfirst($source) }}</span>
                    <x-filament::badge color="primary" size="sm">{{ $count }}</x-filament::badge>
                </div>
            @empty
                <p class="py-2 text-sm text-gray-500">No enquiries this month.</p>
            @endforelse
        </x-filament::section>

        {{-- Quotation Stats --}}
        <x-filament::section heading="Quotation Performance (This Year)">
            <div class="grid grid-cols-2 gap-3">
                <div class="rounded-lg bg-gray-50 p-3 text-center dark:bg-white/5">
                    <p class="text-2xl font-bold text-primary-600">{{ $quotationStats['total_sent'] }}</p>
                    <p class="text-xs text-gray-500">Sent</p>
                </div>
                <div class="rounded-lg bg-gray-50 p-3 text-center dark:bg-white/5">
                    <p class="text-2xl font-bold text-success-600">{{ $quotationStats['accepted'] }}</p>
                    <p class="text-xs text-gray-500">Accepted</p>
                </div>
                <div class="rounded-lg bg-gray-50 p-3 text-center dark:bg-white/5">
                    <p class="text-2xl font-bold text-danger-600">{{ $quotationStats['rejected'] }}</p>
                    <p class="text-xs text-gray-500">Rejected</p>
                </div>
                <div class="rounded-lg bg-gray-50 p-3 text-center dark:bg-white/5">
                    <p class="text-2xl font-bold text-gray-500">{{ $quotationStats['expired'] }}</p>
                    <p class="text-xs text-gray-500">Expired</p>
                </div>
            </div>
            @if($quotationStats['total_sent'] > 0)
                <p class="mt-3 text-sm text-gray-600 dark:text-gray-400">Win Rate: <strong>{{ round(($quotationStats['accepted'] / max($quotationStats['total_sent'], 1)) * 100, 1) }}%</strong> · Avg: <strong>₹{{ number_format($quotationStats['avg_value']) }}</strong></p>
            @endif
        </x-filament::section>
    </div>

    {{-- Monthly Trend --}}
    <x-filament::section heading="Monthly Enquiry Trend">
        <div class="overflow-x-auto">
            <table class="fi-ta-table w-full table-auto divide-y divide-gray-200 dark:divide-white/5">
                <thead>
                    <tr>
                        <th class="px-3 py-3 text-left text-sm font-semibold text-gray-950 dark:text-white">Month</th>
                        <th class="px-3 py-3 text-center text-sm font-semibold text-gray-950 dark:text-white">Enquiries</th>
                        <th class="px-3 py-3 text-center text-sm font-semibold text-gray-950 dark:text-white">Converted</th>
                        <th class="px-3 py-3 text-center text-sm font-semibold text-gray-950 dark:text-white">Rate</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 dark:divide-white/5">
                    @foreach($monthlyEnquiries as $row)
                        <tr>
                            <td class="px-3 py-3 text-sm font-medium text-gray-950 dark:text-white">{{ $row['month'] }}</td>
                            <td class="px-3 py-3 text-sm text-center">{{ $row['count'] }}</td>
                            <td class="px-3 py-3 text-sm text-center text-success-600">{{ $row['converted'] }}</td>
                            <td class="px-3 py-3 text-sm text-center">{{ $row['count'] > 0 ? round(($row['converted'] / $row['count']) * 100) : 0 }}%</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </x-filament::section>

    {{-- Top Destinations --}}
    <x-filament::section heading="Top Destinations (This Year)">
        @forelse($topDestinations as $item)
            <div class="flex items-center justify-between border-b border-gray-100 py-2 last:border-0 dark:border-white/10">
                <span class="text-sm font-medium text-gray-900 dark:text-white">{{ $item->destination?->name ?? 'Unknown' }}</span>
                <x-filament::badge color="primary" size="sm">{{ $item->enquiry_count }}</x-filament::badge>
            </div>
        @empty
            <p class="py-2 text-sm text-gray-500">No data.</p>
        @endforelse
    </x-filament::section>
</x-filament-panels::page>
