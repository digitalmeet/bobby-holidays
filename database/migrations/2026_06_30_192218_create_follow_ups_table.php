<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('follow_ups', function (Blueprint $table) {
            $table->id();
            $table->foreignId('enquiry_id')->constrained('enquiries')->cascadeOnDelete();
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->string('type'); // call, whatsapp, email, meeting, note
            $table->string('status'); // completed, no_answer, busy, rescheduled, callback
            $table->text('notes')->nullable();
            $table->timestamp('scheduled_at')->nullable();
            $table->timestamp('completed_at')->nullable();
            $table->timestamp('next_follow_up_at')->nullable();
            $table->unsignedSmallInteger('duration_seconds')->nullable();
            $table->timestamps();

            $table->index('enquiry_id');
            $table->index('created_by');
            $table->index('scheduled_at');
            $table->index('next_follow_up_at');
            $table->index('status');
            $table->index('type');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('follow_ups');
    }
};
