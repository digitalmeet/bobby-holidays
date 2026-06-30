<?php

namespace App\Filament\Resources\FollowUps\Pages;

use App\Filament\Resources\FollowUps\FollowUpResource;
use App\Models\Enquiry;
use App\Models\FollowUp;
use Filament\Actions\Action;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Resources\Pages\ListRecords;

class ListFollowUps extends ListRecords
{
    protected static string $resource = FollowUpResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Action::make('quick_log')
                ->label('Log Call / Follow-up')
                ->icon('heroicon-o-phone-arrow-up-right')
                ->color('primary')
                ->form([
                    Select::make('enquiry_id')
                        ->label('Client')
                        ->options(fn () => Enquiry::whereNotIn('status', ['converted', 'lost'])
                            ->latest()
                            ->limit(50)
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
                        ->default('call')
                        ->required(),
                    Select::make('status')
                        ->options([
                            'completed' => '✅ Completed',
                            'no_answer' => '📵 No Answer',
                            'busy' => '🔴 Busy',
                            'rescheduled' => '🔄 Rescheduled',
                            'callback' => '📲 Callback',
                        ])
                        ->default('completed')
                        ->required(),
                    Textarea::make('notes')->rows(2)->placeholder('Brief outcome...'),
                    DateTimePicker::make('next_follow_up_at')->label('Next Follow-up'),
                ])
                ->action(function (array $data) {
                    FollowUp::create(array_merge($data, [
                        'created_by' => auth()->id(),
                        'scheduled_at' => now(),
                        'completed_at' => in_array($data['status'], ['completed', 'no_answer', 'busy']) ? now() : null,
                    ]));

                    $enquiry = Enquiry::find($data['enquiry_id']);
                    if ($enquiry) {
                        $update = ['last_contacted_at' => now()];
                        if (!empty($data['next_follow_up_at'])) {
                            $update['follow_up_at'] = $data['next_follow_up_at'];
                        }
                        if ($enquiry->status === 'new') {
                            $update['status'] = 'contacted';
                        }
                        $enquiry->update($update);
                    }
                }),
        ];
    }
}
