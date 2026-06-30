<?php

namespace App\Console\Commands;

use App\Models\Enquiry;
use App\Models\User;
use Filament\Notifications\Notification;
use Illuminate\Console\Command;

class SendFollowUpReminders extends Command
{
    protected $signature = 'enquiries:follow-up-reminders';

    protected $description = 'Send notifications for overdue follow-ups';

    public function handle(): int
    {
        $overdueEnquiries = Enquiry::whereNotNull('follow_up_at')
            ->where('follow_up_at', '<=', now())
            ->whereNotIn('status', ['converted', 'lost'])
            ->whereNotNull('assigned_to')
            ->with('assignedTo')
            ->get();

        $count = 0;

        foreach ($overdueEnquiries as $enquiry) {
            if ($enquiry->assignedTo) {
                Notification::make()
                    ->title('Follow-up Overdue')
                    ->body("Enquiry from {$enquiry->name} ({$enquiry->phone}) — follow-up was due {$enquiry->follow_up_at->diffForHumans()}.")
                    ->icon('heroicon-o-clock')
                    ->warning()
                    ->sendToDatabase($enquiry->assignedTo);

                $count++;
            }
        }

        $this->info("Sent {$count} follow-up reminder(s).");

        return self::SUCCESS;
    }
}
