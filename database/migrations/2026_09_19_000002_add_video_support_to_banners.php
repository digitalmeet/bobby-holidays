<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('banners', function (Blueprint $table): void {
            $table->string('media_type')->default('image')->after('mobile_image');
            $table->string('video_path')->nullable()->after('media_type');
            $table->string('video_poster')->nullable()->after('video_path');
        });
    }

    public function down(): void
    {
        Schema::table('banners', function (Blueprint $table): void {
            $table->dropColumn(['media_type', 'video_path', 'video_poster']);
        });
    }
};
