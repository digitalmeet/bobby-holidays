<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('pages', function (Blueprint $table) {
            $table->string('type')->nullable()->default(null)->after('slug');
            $table->unsignedSmallInteger('sort_order')->default(0)->after('type');
            $table->string('icon')->nullable()->after('sort_order');
            $table->text('short_description')->nullable()->after('icon');

            $table->index('type');
        });
    }

    public function down(): void
    {
        Schema::table('pages', function (Blueprint $table) {
            $table->dropIndex(['type']);
            $table->dropColumn(['type', 'sort_order', 'icon', 'short_description']);
        });
    }
};
