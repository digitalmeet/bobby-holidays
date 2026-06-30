<?php

namespace App\Filament\Resources\Enquiries\RelationManagers;

use App\Models\FollowUp;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class FollowUpsRelationManager extends RelationManager
{
    protected static string $relationship = 'followUps';

    protected static ?string $title = 'Interaction History';

    protected static ?string $recordTitleAttribute = 'type';

    public function form(Schema $schema): Schema
    {
        return $schema->components([
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
                    'callback' => '📲 Callback',
                ])
                ->required(),
            Textarea::make('notes')->rows(3)->placeholder('Discussion, outcome, action items...')->columnSpanFull(),
            DateTimePicker::make('scheduled_at')->label('When')->default(now()),
            DateTimePicker::make('completed_at')->label('Completed At'),
            DateTimePicker::make('next_follow_up_at')->label('Next Follow-up'),
            TextInput::make('duration_seconds')->label('Duration (sec)')->numeric(),
        ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->defaultSort('created_at', 'desc')
            ->columns([
                TextColumn::make('type')
                    ->badge()
                    ->formatStateUsing(fn (string $state) => match ($state) {
                        'call' => '📞 Call',
                        'whatsapp' => '💬 WA',
                        'email' => '📧 Email',
                        'meeting' => '🤝 Meet',
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
                TextColumn::make('notes')
                    ->limit(50)
                    ->placeholder('No notes'),
                TextColumn::make('scheduled_at')
                    ->label('When')
                    ->dateTime('d M, h:i A')
                    ->sortable(),
                TextColumn::make('createdBy.name')
                    ->label('By')
                    ->placeholder('System'),
                TextColumn::make('next_follow_up_at')
                    ->label('Next')
                    ->dateTime('d M')
                    ->placeholder('—'),
            ])
            ->headerActions([
                CreateAction::make()
                    ->label('Log Interaction')
                    ->mutateFormDataUsing(function (array $data): array {
                        $data['created_by'] = auth()->id();
                        if (in_array($data['status'] ?? '', ['completed', 'no_answer', 'busy'])) {
                            $data['completed_at'] = $data['completed_at'] ?? now();
                        }
                        return $data;
                    })
                    ->after(function () {
                        // Update enquiry last_contacted_at
                        $enquiry = $this->getOwnerRecord();
                        $enquiry->update(['last_contacted_at' => now()]);
                        if ($enquiry->status === 'new') {
                            $enquiry->update(['status' => 'contacted']);
                        }
                    }),
            ])
            ->recordActions([
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([DeleteBulkAction::make()]),
            ]);
    }
}
