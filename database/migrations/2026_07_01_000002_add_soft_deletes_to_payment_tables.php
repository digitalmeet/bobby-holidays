<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // payments.deleted_at already exists — only add to online_payments
        Schema::table('online_payments', function (Blueprint $table) {
            $table->softDeletes()->after('paid_at');
        });
    }

    public function down(): void
    {
        Schema::table('online_payments', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
    }
};
