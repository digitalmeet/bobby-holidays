<?php

namespace App\Filament\Pages;

use App\Models\Booking;
use BackedEnum;
use Filament\Pages\Page;
use Filament\Support\Icons\Heroicon;
use Illuminate\Support\Facades\Cache;
use UnitEnum;

class BookingsReport extends Page
{
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedTicket;

    protected string $view = 'filament.pages.bookings-report';

    protected static ?string $title = 'Bookings Report';

    protected static string|UnitEnum|null $navigationGroup = 'Reports';

    protected static ?int $navigationSort = 3;

    public static function canAccess(): bool
    {
        return auth()->user()?->hasAnyRole(['super_admin', 'operations']) ?? false;
    }

    public function getViewData(): array
    {
        return Cache::remember('report.bookings', 300, function () {
            $thisYear = now()->startOfYear();

            $statusCounts = Booking::selectRaw('status, COUNT(*) as count')
                ->groupBy('status')
                ->pluck('count', 'status')
                ->toArray();

            $monthlyBookings = [];
            for ($i = 5; $i >= 0; $i--) {
                $date = now()->subMonths($i);
                $start = $date->copy()->startOfMonth();
                $end = $date->copy()->endOfMonth();
                $monthlyBookings[] = [
                    'month' => $date->format('M Y'),
                    'total' => Booking::whereBetween('created_at', [$start, $end])->count(),
                    'value' => Booking::whereBetween('created_at', [$start, $end])->sum('total_amount'),
                    'cancelled' => Booking::where('status', 'cancelled')->whereBetween('cancelled_at', [$start, $end])->count(),
                ];
            }

            $upcomingCount = Booking::where('travel_date', '>=', now())
                ->where('travel_date', '<=', now()->addDays(30))
                ->whereNotIn('status', ['cancelled', 'refunded'])
                ->count();

            $overduePayments = Booking::where('balance_amount', '>', 0)
                ->whereIn('status', ['confirmed', 'partial_paid'])
                ->where('travel_date', '<=', now()->addDays(15))
                ->count();

            return compact('statusCounts', 'monthlyBookings', 'upcomingCount', 'overduePayments');
        });
    }
}
