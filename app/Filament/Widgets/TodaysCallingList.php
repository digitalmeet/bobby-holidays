<?php

namespace App\Filament\Widgets;

use App\Filament\Resources\Enquiries\EnquiryResource;
use App\Filament\Resources\FollowUps\FollowUpResource;
use App\Models\FollowUp;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget;

class TodaysCallingList extends TableWidget
{
    protected static ?int $sort = 2;

    protected static ?string $heading = "Today's Calling List";

    protected int|string|array $columnSpan = 'full';

    protected static bool $isLazy = true;

    public static function canView(): bool
    {
        return auth()->user()?->hasAnyRole(['super_admin', 'sales']) ?? false;
    }

    public function table(Table $table): Table
    {
        return $table
            ->query(
                FollowUp::query()
                    ->with(['enquiry.destination'])
                    ->where(function ($q) {
                        $q->whereDate('scheduled_at', today())
                            ->orWhere(function ($q2) {
                                $q2->where('scheduled_at', '<', now())
                                    ->whereNull('completed_at');
                            });
                    })
                    ->whereNull('completed_at')
                    ->orderBy('scheduled_at')
                    ->limit(15)
            )
            ->columns([
                TextColumn::make('enquiry.name')
                    ->label('Client')
                    ->weight('bold')
                    ->description(fn (FollowUp $record) => $record->enquiry?->phone),
                TextColumn::make('enquiry.destination.name')
                    ->label('Destination')
                    ->placeholder('—'),
                TextColumn::make('type')
                    ->badge()
                    ->formatStateUsing(fn (string $state) => match ($state) {
                        'call' => '📞 Call',
                        'whatsapp' => '💬 WA',
                        'email' => '📧 Email',
                        'meeting' => '🤝 Meet',
                        default => $state,
                    })
                    ->color('gray'),
                TextColumn::make('scheduled_at')
                    ->label('Time')
                    ->time('h:i A')
                    ->color(fn (FollowUp $record) => $record->scheduled_at?->isPast() ? 'danger' : 'success')
                    ->description(fn (FollowUp $record) => $record->scheduled_at?->isToday() ? 'Today' : $record->scheduled_at?->diffForHumans()),
                TextColumn::make('enquiry.status')
                    ->label('Enquiry')
                    ->badge()
                    ->color(fn (string $state) => match ($state) {
                        'new' => 'danger',
                        'contacted' => 'warning',
                        'quoted' => 'info',
                        default => 'gray',
                    }),
            ])
            ->recordUrl(fn (FollowUp $record) => EnquiryResource::getUrl('edit', ['record' => $record->enquiry_id]))
            ->emptyStateHeading('No calls for today')
            ->emptyStateDescription('All caught up! Use Follow-ups page to schedule new calls.')
            ->emptyStateIcon('heroicon-o-check-circle');
    }
}
