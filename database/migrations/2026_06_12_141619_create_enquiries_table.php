<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('enquiries', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tour_id')
                ->nullable()
                ->constrained('tours')
                ->nullOnDelete();
            $table->foreignId('destination_id')
                ->nullable()
                ->constrained('destinations')
                ->nullOnDelete();
            $table->string('name');
            $table->string('email')->nullable();
            $table->string('phone');
            $table->string('country')->nullable();
            $table->date('travel_date')->nullable();
            $table->boolean('flexible_dates')->default(false);
            $table->unsignedSmallInteger('duration_days')->nullable();
            $table->unsignedTinyInteger('adults')->default(1);
            $table->unsignedTinyInteger('children')->default(0);
            $table->unsignedTinyInteger('infants')->default(0);
            $table->string('budget_range')->nullable();
            $table->text('message')->nullable();
            $table->string('status')->default('new');
            $table->string('source')->default('website');
            $table->foreignId('assigned_to')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();
            $table->timestamp('last_contacted_at')->nullable();
            $table->timestamp('follow_up_at')->nullable();
            $table->text('internal_notes')->nullable();
            $table->string('ip_address')->nullable();
            $table->text('user_agent')->nullable();
            $table->softDeletes();
            $table->timestamps();

            // Indexes for performance
            $table->index('tour_id');
            $table->index('destination_id');
            $table->index('assigned_to');
            $table->index('status');
            $table->index('source');
            $table->index('travel_date');
            $table->index('follow_up_at');
            $table->index('created_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('enquiries');
    }
};
