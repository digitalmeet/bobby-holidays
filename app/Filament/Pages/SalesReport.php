<?php

namespace App\Filament\Pages;

use App\Models\Enquiry;
use App\Models\Quotation;
use BackedEnum;
use Filament\Pages\Page;
use Filament\Support\Icons\Heroicon;
use Illuminate\Support\Facades\Cache;
use UnitEnum;

class SalesReport extends Page
{
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedChartBar;

    protected string $view = 'filament.pages.sales-report';

    protected static ?string $title = 'Sales Report';

    protected static string|UnitEnum|null $navigationGroup = 'Reports';

    protected static ?int $navigationSort = 1;

    public static function canAccess(): bool
    {
        return auth()->user()?->hasAnyRole(['super_admin', 'sales']) ?? false;
    }

    public function getViewData(): array
    {
        return Cache::remember('report.sales', 300, function () {
            $thisMonth = now()->startOfMonth();
            $thisYear = now()->startOfYear();

            $pipeline = [
                'new' => Enquiry::where('status', 'new')->count(),
                'contacted' => Enquiry::where('status', 'contacted')->count(),
                'quoted' => Enquiry::where('status', 'quoted')->count(),
                'converted' => Enquiry::where('status', 'converted')->where('created_at', '>=', $thisYear)->count(),
                'lost' => Enquiry::where('status', 'lost')->where('created_at', '>=', $thisYear)->count(),
            ];

            $sources = Enquiry::where('created_at', '>=', $thisMonth)
                ->selectRaw('source, COUNT(*) as count')
                ->groupBy('source')
                ->pluck('count', 'source')
                ->toArray();

            $quotationStats = [
                'total_sent' => Quotation::whereNotNull('sent_at')->where('created_at', '>=', $thisYear)->count(),
                'accepted' => Quotation::where('status', 'accepted')->where('created_at', '>=', $thisYear)->count(),
                'rejected' => Quotation::where('status', 'rejected')->where('created_at', '>=', $thisYear)->count(),
                'expired' => Quotation::where('status', 'expired')->where('created_at', '>=', $thisYear)->count(),
                'avg_value' => Quotation::where('status', 'accepted')->where('created_at', '>=', $thisYear)->avg('total_amount') ?? 0,
            ];

            $topDestinations = Enquiry::whereNotNull('destination_id')
                ->where('created_at', '>=', $thisYear)
                ->selectRaw('destination_id, COUNT(*) as enquiry_count')
                ->groupBy('destination_id')
                ->orderByDesc('enquiry_count')
                ->with('destination')
                ->limit(10)
                ->get();

            $monthlyEnquiries = [];
            for ($i = 5; $i >= 0; $i--) {
                $date = now()->subMonths($i);
                $monthlyEnquiries[] = [
                    'month' => $date->format('M'),
                    'count' => Enquiry::whereYear('created_at', $date->year)->whereMonth('created_at', $date->month)->count(),
                    'converted' => Enquiry::where('status', 'converted')->whereYear('created_at', $date->year)->whereMonth('created_at', $date->month)->count(),
                ];
            }

            return compact('pipeline', 'sources', 'quotationStats', 'topDestinations', 'monthlyEnquiries');
        });
    }
}
