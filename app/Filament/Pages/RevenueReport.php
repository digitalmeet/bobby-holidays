<?php

namespace App\Filament\Pages;

use App\Models\Booking;
use App\Models\Payment;
use BackedEnum;
use Filament\Pages\Page;
use Filament\Support\Icons\Heroicon;
use UnitEnum;

class RevenueReport extends Page
{
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedCurrencyRupee;

    protected string $view = 'filament.pages.revenue-report';

    protected static ?string $title = 'Revenue Report';

    protected static string|UnitEnum|null $navigationGroup = 'Reports';

    protected static ?int $navigationSort = 2;

    public static function canAccess(): bool
    {
        return auth()->user()?->hasRole('super_admin') ?? false;
    }

    public function getViewData(): array
    {
        $thisMonth = now()->startOfMonth();
        $thisYear = now()->startOfYear();

        $revenueSummary = [
            'this_month' => Payment::where('status', 'received')->where('payment_date', '>=', $thisMonth)->sum('amount'),
            'this_year' => Payment::where('status', 'received')->where('payment_date', '>=', $thisYear)->sum('amount'),
            'total_bookings_value' => Booking::whereNotIn('status', ['cancelled', 'refunded'])->sum('total_amount'),
            'total_collected' => Payment::where('status', 'received')->sum('amount'),
            'total_pending' => Booking::whereIn('status', ['confirmed', 'partial_paid'])->sum('balance_amount'),
        ];

        $monthlyRevenue = [];
        for ($i = 5; $i >= 0; $i--) {
            $date = now()->subMonths($i);
            $start = $date->copy()->startOfMonth();
            $end = $date->copy()->endOfMonth();
            $monthlyRevenue[] = [
                'month' => $date->format('M Y'),
                'revenue' => Payment::where('status', 'received')->whereBetween('payment_date', [$start, $end])->sum('amount'),
                'bookings' => Booking::whereBetween('created_at', [$start, $end])->count(),
                'cancellations' => Booking::where('status', 'cancelled')->whereBetween('cancelled_at', [$start, $end])->count(),
            ];
        }

        $paymentMethods = Payment::where('status', 'received')
            ->where('payment_date', '>=', $thisYear)
            ->selectRaw('method, COUNT(*) as count, SUM(amount) as total')
            ->groupBy('method')
            ->get();

        return compact('revenueSummary', 'monthlyRevenue', 'paymentMethods');
    }
}
