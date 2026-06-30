<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    private array $modules = ['enquiry', 'booking', 'quotation', 'tour', 'page'];

    public function up(): void
    {
        // Drop the generic activity_logs table
        Schema::dropIfExists('activity_logs');

        // Create per-module log tables
        foreach ($this->modules as $module) {
            Schema::create("{$module}_logs", function (Blueprint $table) use ($module) {
                $table->id();
                $table->unsignedBigInteger('record_id');
                $table->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete();
                $table->string('action'); // created, updated, deleted, restored, status_changed, etc.
                $table->string('description')->nullable();
                $table->json('old_values')->nullable();
                $table->json('new_values')->nullable();
                $table->string('ip_address')->nullable();
                $table->timestamp('created_at')->nullable();

                $table->index('record_id');
                $table->index('user_id');
                $table->index('action');
                $table->index('created_at');
            });
        }
    }

    public function down(): void
    {
        foreach ($this->modules as $module) {
            Schema::dropIfExists("{$module}_logs");
        }

        // Recreate generic table on rollback
        Schema::create('activity_logs', function (Blueprint $table) {
            $table->id();
            $table->string('module');
            $table->string('loggable_type');
            $table->unsignedBigInteger('loggable_id');
            $table->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete();
            $table->string('action');
            $table->string('description')->nullable();
            $table->json('old_values')->nullable();
            $table->json('new_values')->nullable();
            $table->string('ip_address')->nullable();
            $table->timestamp('created_at')->nullable();
            $table->index(['loggable_type', 'loggable_id']);
            $table->index('module');
        });
    }
};
