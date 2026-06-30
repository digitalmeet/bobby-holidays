<?php

namespace App\Filament\Widgets;

use App\Models\Booking;
use App\Models\Enquiry;
use App\Models\Payment;
use App\Models\Quotation;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Facades\Cache;

class StatsOverview extends StatsOverviewWidget
{
    protected static ?int $sort = 1;

    protected int|string|array $columnSpan = 'full';

    protected string|null $pollingInterval = '30s';

    protected function getStats(): array
    {
        $stats = Cache::remember('dashboard_stats', 60, function () {
            $thisMonth = now()->startOfMonth();

            $newEnquiries = Enquiry::where('status', 'new')->count();
            $thisMonthEnquiries = Enquiry::where('created_at', '>=', $thisMonth)->count();
            $draftQuotations = Quotation::where('status', 'draft')->count();
            $sentQuotations = Quotation::whereIn('status', ['sent', 'viewed'])->count();
            $activeBookings = Booking::whereIn('status', ['confirmed', 'partial_paid', 'fully_paid'])->count();
            $thisMonthBookings = Booking::where('created_at', '>=', $thisMonth)->count();
            $revenueThisMonth = Payment::where('status', 'received')->where('payment_date', '>=', $thisMonth)->sum('amount');
            $pendingBalance = Booking::whereIn('status', ['confirmed', 'partial_paid'])->sum('balance_amount');
            $totalConverted = Enquiry::where('status', 'converted')->where('created_at', '>=', $thisMonth)->count();
            $conversionRate = $thisMonthEnquiries > 0 ? round(($totalConverted / $thisMonthEnquiries) * 100, 1) : 0;

            return compact(
                'newEnquiries', 'thisMonthEnquiries', 'draftQuotations', 'sentQuotations',
                'activeBookings', 'thisMonthBookings', 'revenueThisMonth', 'pendingBalance',
                'totalConverted', 'conversionRate'
            );
        });

        return [
            Stat::make('New Enquiries', $stats['newEnquiries'])
                ->description($stats['thisMonthEnquiries'] . ' this month')
                ->descriptionIcon('heroicon-o-chat-bubble-left-right')
                ->color('danger'),

            Stat::make('Pending Quotes', $stats['draftQuotations'] + $stats['sentQuotations'])
                ->description("{$stats['draftQuotations']} draft, {$stats['sentQuotations']} awaiting")
                ->descriptionIcon('heroicon-o-document-text')
                ->color('warning'),

            Stat::make('Conversion', $stats['conversionRate'] . '%')
                ->description($stats['totalConverted'] . ' converted this month')
                ->descriptionIcon('heroicon-o-arrow-trending-up')
                ->color($stats['conversionRate'] >= 20 ? 'success' : 'warning'),

            Stat::make('Active Bookings', $stats['activeBookings'])
                ->description($stats['thisMonthBookings'] . ' new this month')
                ->descriptionIcon('heroicon-o-ticket')
                ->color('primary'),

            Stat::make('Revenue', '₹' . number_format($stats['revenueThisMonth'], 0))
                ->description('This month')
                ->descriptionIcon('heroicon-o-currency-rupee')
                ->color('success'),

            Stat::make('Balance Due', '₹' . number_format($stats['pendingBalance'], 0))
                ->description(Booking::where('balance_amount', '>', 0)->whereNotIn('status', ['cancelled', 'refunded'])->count() . ' bookings')
                ->descriptionIcon('heroicon-o-exclamation-triangle')
                ->color($stats['pendingBalance'] > 0 ? 'danger' : 'success'),
        ];
    }
}
