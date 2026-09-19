<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    private const MODULES = ['payment', 'online_payment'];

    public function up(): void
    {
        foreach (self::MODULES as $module) {
            $tableName = "{$module}_logs";

            if (Schema::hasTable($tableName)) {
                continue;
            }

            Schema::create($tableName, function (Blueprint $table): void {
                $table->id();
                $table->unsignedBigInteger('record_id');
                $table->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete();
                $table->string('action');
                $table->string('description')->nullable();
                $table->json('old_values')->nullable();
                $table->json('new_values')->nullable();
                $table->string('ip_address', 45)->nullable();
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
        foreach (array_reverse(self::MODULES) as $module) {
            Schema::dropIfExists("{$module}_logs");
        }
    }
};
