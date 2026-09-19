<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('online_payments', function (Blueprint $table): void {
            $table->dropIndex(['order_id']);
            $table->unique(['gateway', 'order_id']);
        });

        Schema::table('payments', function (Blueprint $table): void {
            $table->foreignId('online_payment_id')
                ->nullable()
                ->after('booking_id')
                ->unique()
                ->constrained('online_payments')
                ->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('payments', function (Blueprint $table): void {
            $table->dropConstrainedForeignId('online_payment_id');
        });

        Schema::table('online_payments', function (Blueprint $table): void {
            $table->dropUnique(['gateway', 'order_id']);
            $table->index('order_id');
        });
    }
};
