<?php

namespace App\Console\Commands;

use App\Models\Quotation;
use Illuminate\Console\Command;

class ExpireQuotations extends Command
{
    protected $signature = 'quotations:expire';

    protected $description = 'Mark quotations as expired when validity_date has passed';

    public function handle(): int
    {
        $expired = Quotation::whereNotNull('validity_date')
            ->where('validity_date', '<', now())
            ->whereIn('status', ['sent', 'viewed', 'draft'])
            ->get();

        $count = 0;

        foreach ($expired as $quotation) {
            $oldStatus = $quotation->status;
            $quotation->update(['status' => 'expired']);

            $quotation->histories()->create([
                'event' => 'expired',
                'old_status' => $oldStatus,
                'new_status' => 'expired',
                'notes' => 'Auto-expired by system. Validity date was ' . $quotation->validity_date->format('d M Y') . '.',
                'created_at' => now(),
            ]);

            $count++;
        }

        $this->info("Expired {$count} quotation(s).");

        return self::SUCCESS;
    }
}
