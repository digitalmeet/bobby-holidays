<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('enquiries', function (Blueprint $table) {
            $table->index(['status', 'created_at'], 'enquiries_status_created_composite');
        });

        Schema::table('bookings', function (Blueprint $table) {
            $table->index(['status', 'created_at'], 'bookings_status_created_composite');
            $table->index(['status', 'balance_amount'], 'bookings_status_balance_composite');
        });

        Schema::table('payments', function (Blueprint $table) {
            $table->index(['status', 'payment_date'], 'payments_status_date_composite');
        });
    }

    public function down(): void
    {
        Schema::table('enquiries', function (Blueprint $table) {
            $table->dropIndex('enquiries_status_created_composite');
        });

        Schema::table('bookings', function (Blueprint $table) {
            $table->dropIndex('bookings_status_created_composite');
            $table->dropIndex('bookings_status_balance_composite');
        });

        Schema::table('payments', function (Blueprint $table) {
            $table->dropIndex('payments_status_date_composite');
        });
    }
};
