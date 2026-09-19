<?php

namespace App\Filament\Pages;

use App\Models\BookingStatusHistory;
use App\Models\PaymentHistory;
use App\Models\QuotationHistory;
use App\Models\User;
use BackedEnum;
use Filament\Pages\Page;
use Filament\Support\Icons\Heroicon;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use UnitEnum;

class ActivityReport extends Page
{
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedShieldCheck;

    protected string $view = 'filament.pages.activity-report';

    protected static ?string $title = 'Audit & Activity Report';

    protected static string|UnitEnum|null $navigationGroup = 'Reports';

    protected static ?int $navigationSort = 4;

    public static function canAccess(): bool
    {
        return auth()->user()?->hasRole('super_admin') ?? false;
    }

    public function getViewData(): array
    {
        return Cache::remember('report.activity', 60, function (): array {
            $tables = collect(config('activity-log.tables', []))
                ->filter(fn (string $table): bool => Schema::hasTable($table));
            $weekStart = now()->subDays(6)->startOfDay();
            $monthStart = now()->subDays(29)->startOfDay();
            $recentActivity = collect();
            $actorIds = collect();
            $moduleStats = [];
            $dailyActivity = collect(range(0, 6))->mapWithKeys(function (int $daysAgo): array {
                $date = now()->subDays(6 - $daysAgo);

                return [$date->toDateString() => ['label' => $date->format('D'), 'count' => 0]];
            })->all();

            $summary = [
                'today' => 0,
                'week' => 0,
                'risk_events' => 0,
                'active_users' => 0,
            ];

            foreach ($tables as $table) {
                $module = str($table)->beforeLast('_logs')->replace('_', ' ')->title()->toString();
                $query = DB::table($table);
                $todayCount = (clone $query)->where('created_at', '>=', today())->count();
                $weekCount = (clone $query)->where('created_at', '>=', $weekStart)->count();

                $summary['today'] += $todayCount;
                $summary['week'] += $weekCount;
                $summary['risk_events'] += (clone $query)
                    ->where('created_at', '>=', $monthStart)
                    ->whereIn('action', ['deleted', 'force_deleted', 'refunded', 'cancelled'])
                    ->count();

                $moduleStats[] = [
                    'module' => $module,
                    'today' => $todayCount,
                    'week' => $weekCount,
                ];

                (clone $query)
                    ->where('created_at', '>=', $weekStart)
                    ->selectRaw('DATE(created_at) as activity_date, COUNT(*) as aggregate')
                    ->groupBy('activity_date')
                    ->get()
                    ->each(function (object $row) use (&$dailyActivity): void {
                        if (isset($dailyActivity[$row->activity_date])) {
                            $dailyActivity[$row->activity_date]['count'] += (int) $row->aggregate;
                        }
                    });

                $rows = (clone $query)
                    ->latest('created_at')
                    ->limit(12)
                    ->get(['record_id', 'user_id', 'action', 'description', 'ip_address', 'created_at'])
                    ->map(function (object $row) use ($module): object {
                        $row->module = $module;

                        return $row;
                    });

                $recentActivity = $recentActivity->concat($rows);
                $actorIds = $actorIds->concat($rows->pluck('user_id')->filter());
            }

            $recentActivity = $recentActivity
                ->sortByDesc('created_at')
                ->take(25)
                ->values();
            $actorNames = User::whereIn('id', $actorIds->unique())->pluck('name', 'id');
            $summary['active_users'] = $actorIds->unique()->count();

            $recentActivity->each(function (object $row) use ($actorNames): void {
                $row->actor = $row->user_id ? ($actorNames[$row->user_id] ?? 'Former user') : 'System';
            });

            $workflow = [
                'booking_changes' => Schema::hasTable('booking_status_histories')
                    ? BookingStatusHistory::where('created_at', '>=', $monthStart)->count()
                    : 0,
                'quotation_events' => Schema::hasTable('quotation_histories')
                    ? QuotationHistory::where('created_at', '>=', $monthStart)->count()
                    : 0,
                'payment_events' => Schema::hasTable('payment_histories')
                    ? PaymentHistory::where('created_at', '>=', $monthStart)->count()
                    : 0,
            ];

            // Cache only framework-agnostic scalar arrays. Database cache rows may be
            // unserialized before Collection is autoloaded by a persistent PHP worker.
            $moduleStats = collect($moduleStats)->sortByDesc('week')->values()->all();
            $recentActivity = $recentActivity
                ->map(fn (object $row): array => (array) $row)
                ->all();

            return compact('summary', 'dailyActivity', 'moduleStats', 'recentActivity', 'workflow');
        });
    }
}
