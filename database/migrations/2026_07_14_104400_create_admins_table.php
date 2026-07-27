<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('admins', function (Blueprint $table) {
            $table->id();

            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');

            $table->string('role')->default('content_manager');
            $table->boolean('is_active')->default(true);

            $table->rememberToken();
            $table->timestamps();

            $table->index([
                'role',
                'is_active',
            ]);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('admins');
    }
};