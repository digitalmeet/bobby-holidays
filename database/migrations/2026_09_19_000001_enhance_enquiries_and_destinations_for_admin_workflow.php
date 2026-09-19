<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('enquiries', function (Blueprint $table): void {
            $table->text('address')->nullable()->after('country');
            $table->string('destination_other')->nullable()->after('destination_id');
            $table->string('tour_other')->nullable()->after('tour_id');
            $table->unsignedInteger('budget_min')->nullable()->after('budget_range');
            $table->unsignedInteger('budget_max')->nullable()->after('budget_min');
            $table->index(['budget_min', 'budget_max']);
        });

        Schema::table('destinations', function (Blueprint $table): void {
            $table->string('state')->nullable()->after('country');
            $table->string('city')->nullable()->after('state');
            $table->index(['country', 'state', 'city']);
        });
    }

    public function down(): void
    {
        Schema::table('destinations', function (Blueprint $table): void {
            $table->dropIndex(['country', 'state', 'city']);
            $table->dropColumn(['state', 'city']);
        });

        Schema::table('enquiries', function (Blueprint $table): void {
            $table->dropIndex(['budget_min', 'budget_max']);
            $table->dropColumn(['address', 'destination_other', 'tour_other', 'budget_min', 'budget_max']);
        });
    }
};
