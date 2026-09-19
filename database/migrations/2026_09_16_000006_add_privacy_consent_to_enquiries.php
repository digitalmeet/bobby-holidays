<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('enquiries', function (Blueprint $table) {
            $table->timestamp('privacy_accepted_at')->nullable()->after('user_agent');
            $table->string('privacy_policy_version', 32)->nullable()->after('privacy_accepted_at');
            $table->string('consent_source', 100)->nullable()->after('privacy_policy_version');
        });
    }

    public function down(): void
    {
        Schema::table('enquiries', function (Blueprint $table) {
            $table->dropColumn([
                'privacy_accepted_at',
                'privacy_policy_version',
                'consent_source',
            ]);
        });
    }
};
