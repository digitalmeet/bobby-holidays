<?php

namespace App\Filament\Resources\FollowUps;

use App\Filament\Resources\Enquiries\EnquiryResource;
use App\Filament\Resources\FollowUps\Pages\ListFollowUps;
use App\Models\Enquiry;
use App\Models\FollowUp;
use BackedEnum;
use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use UnitEnum;

class FollowUpResource extends Resource
{
    protected static ?string $model = FollowUp::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedPhoneArrowUpRight;

    protected static ?string $recordTitleAttribute = 'enquiry.name';

    protected static string|UnitEnum|null $navigationGroup = 'Sales Pipeline';

    protected static ?int $navigationSort = 3;

    protected static ?string $label = 'Follow-up';

    protected static ?string $pluralLabel = 'Follow-ups & Calls';

    public static function getNavigationBadge(): ?string
    {
        $count = FollowUp::where('scheduled_at', '<=', now())
            ->whereNull('completed_at')
            ->count();
        return $count ?: null;
    }

    public static function getNavigationBadgeColor(): ?string
    {
        return 'danger';
    }

    public static function form(Schema $schema): Schema
    {
        return $schema->components([
            Select::make('enquiry_id')
                ->label('Enquiry')
                ->options(fn () => Enquiry::whereNotIn('status', ['converted', 'lost'])
                    ->latest()
                    ->limit(100)
                    ->get()
                    ->mapWithKeys(fn ($e) => [$e->id => "{$e->name} — {$e->phone}"]))
                ->searchable()
                ->required(),
            Select::make('type')
                ->options([
                    'call' => '📞 Phone Call',
                    'whatsapp' => '💬 WhatsApp',
                    'email' => '📧 Email',
                    'meeting' => '🤝 Meeting',
                    'note' => '📝 Note',
                ])
                ->required(),
            Select::make('status')
                ->options([
                    'completed' => '✅ Completed',
                    'no_answer' => '📵 No Answer',
                    'busy' => '🔴 Busy',
                    'rescheduled' => '🔄 Rescheduled',
                    'callback' => '📲 Callback Requested',
                ])
                ->required(),
            DateTimePicker::make('scheduled_at')
                ->label('Scheduled For')
                ->default(now()),
            DateTimePicker::make('completed_at')
                ->label('Completed At'),
            DateTimePicker::make('next_follow_up_at')
                ->label('Next Follow-up'),
            TextInput::make('duration_seconds')
                ->label('Duration (seconds)')
                ->numeric()
                ->placeholder('e.g. 120 for 2 min call'),
            Textarea::make('notes')
                ->rows(3)
                ->placeholder('What was discussed, outcome, next action...')
                ->columnSpanFull(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->defaultSort('scheduled_at', 'desc')
            ->query(FollowUp::query()->with(['enquiry', 'createdBy']))
            ->columns([
                TextColumn::make('enquiry.name')
                    ->label('Client')
                    ->searchable()
                    ->description(fn (FollowUp $record) => $record->enquiry?->phone),
                TextColumn::make('enquiry.destination.name')
                    ->label('Destination')
                    ->placeholder('—'),
                TextColumn::make('type')
                    ->badge()
                    ->formatStateUsing(fn (string $state) => match ($state) {
                        'call' => '📞 Call',
                        'whatsapp' => '💬 WhatsApp',
                        'email' => '📧 Email',
                        'meeting' => '🤝 Meeting',
                        'note' => '📝 Note',
                        default => $state,
                    })
                    ->color('gray'),
                TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state) => match ($state) {
                        'completed' => 'success',
                        'no_answer' => 'warning',
                        'busy' => 'danger',
                        'rescheduled' => 'info',
                        'callback' => 'primary',
                        default => 'gray',
                    }),
                TextColumn::make('scheduled_at')
                    ->label('Scheduled')
                    ->dateTime('d M, h:i A')
                    ->sortable()
                    ->color(fn (FollowUp $record) => $record->scheduled_at?->isPast() && !$record->completed_at ? 'danger' : null),
                TextColumn::make('next_follow_up_at')
                    ->label('Next')
                    ->dateTime('d M, h:i A')
                    ->placeholder('—')
                    ->sortable(),
                TextColumn::make('notes')
                    ->limit(30)
                    ->placeholder('—')
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('createdBy.name')
                    ->label('By')
                    ->placeholder('—')
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Filter::make('today')
                    ->label("Today's Calls")
                    ->default()
                    ->query(fn (Builder $query) => $query->whereDate('scheduled_at', today())),
                Filter::make('overdue')
                    ->label('Overdue')
                    ->query(fn (Builder $query) => $query->overdue()),
                Filter::make('upcoming')
                    ->label('Upcoming')
                    ->query(fn (Builder $query) => $query->upcoming()),
                Filter::make('pending')
                    ->label('Not Completed')
                    ->query(fn (Builder $query) => $query->pending()),
                SelectFilter::make('type')
                    ->options([
                        'call' => 'Phone Call',
                        'whatsapp' => 'WhatsApp',
                        'email' => 'Email',
                        'meeting' => 'Meeting',
                        'note' => 'Note',
                    ]),
                SelectFilter::make('status')
                    ->options([
                        'completed' => 'Completed',
                        'no_answer' => 'No Answer',
                        'busy' => 'Busy',
                        'rescheduled' => 'Rescheduled',
                        'callback' => 'Callback',
                    ]),
            ])
            ->recordActions([
                Action::make('mark_completed')
                    ->label('Done')
                    ->icon('heroicon-o-check-circle')
                    ->color('success')
                    ->visible(fn (FollowUp $record) => !$record->completed_at)
                    ->form([
                        Select::make('status')
                            ->options([
                                'completed' => '✅ Completed',
                                'no_answer' => '📵 No Answer',
                                'busy' => '🔴 Busy',
                                'callback' => '📲 Callback',
                            ])
                            ->default('completed')
                            ->required(),
                        Textarea::make('notes')->rows(2)->placeholder('Outcome...'),
                        DateTimePicker::make('next_follow_up_at')->label('Schedule Next Follow-up'),
                    ])
                    ->action(function (FollowUp $record, array $data) {
                        $record->update([
                            'status' => $data['status'],
                            'completed_at' => now(),
                            'notes' => $data['notes'] ?? $record->notes,
                            'next_follow_up_at' => $data['next_follow_up_at'] ?? null,
                        ]);

                        // Update enquiry's follow_up_at and last_contacted_at
                        $enquiry = $record->enquiry;
                        $updateData = ['last_contacted_at' => now()];
                        if (!empty($data['next_follow_up_at'])) {
                            $updateData['follow_up_at'] = $data['next_follow_up_at'];

                            // Auto-create next follow-up record
                            FollowUp::create([
                                'enquiry_id' => $enquiry->id,
                                'created_by' => auth()->id(),
                                'type' => 'call',
                                'status' => 'callback',
                                'scheduled_at' => $data['next_follow_up_at'],
                            ]);
                        }
                        if ($enquiry->status === 'new') {
                            $updateData['status'] = 'contacted';
                        }
                        $enquiry->update($updateData);
                    }),
                Action::make('view_enquiry')
                    ->label('Profile')
                    ->icon('heroicon-o-user')
                    ->color('gray')
                    ->url(fn (FollowUp $record) => EnquiryResource::getUrl('edit', ['record' => $record->enquiry_id])),
                Action::make('whatsapp')
                    ->label('WA')
                    ->icon('heroicon-o-chat-bubble-left-ellipsis')
                    ->color('success')
                    ->url(fn (FollowUp $record) => 'https://wa.me/' . preg_replace('/[^0-9]/', '', $record->enquiry?->phone ?? ''))
                    ->openUrlInNewTab(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([DeleteBulkAction::make()]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListFollowUps::route('/'),
        ];
    }
}
