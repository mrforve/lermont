<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('contact_requests', function (Blueprint $table): void {
            $table
                ->timestamp('consent_at')
                ->nullable()
                ->after('user_agent');

            $table
                ->string('consent_text_version', 50)
                ->nullable()
                ->after('consent_at');
        });
    }

    public function down(): void
    {
        Schema::table('contact_requests', function (Blueprint $table): void {
            $table->dropColumn([
                'consent_at',
                'consent_text_version',
            ]);
        });
    }
};