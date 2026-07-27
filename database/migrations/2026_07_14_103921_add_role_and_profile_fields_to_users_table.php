<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('role')
                ->default('user')
                ->after('password');

            $table->string('phone')
                ->nullable()
                ->after('email');

            $table->string('last_name')
                ->nullable()
                ->after('name');

            $table->string('middle_name')
                ->nullable()
                ->after('last_name');

            $table->boolean('is_active')
                ->default(true)
                ->after('role');

            $table->index(['role', 'is_active']);
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropIndex(['role', 'is_active']);

            $table->dropColumn([
                'role',
                'phone',
                'last_name',
                'middle_name',
                'is_active',
            ]);
        });
    }
};