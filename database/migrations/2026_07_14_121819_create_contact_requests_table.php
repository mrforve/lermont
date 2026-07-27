<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('contact_requests', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')
                ->nullable()
                ->constrained()
                ->nullOnDelete();

            $table->string('type')->default('message');

            $table->string('name');
            $table->string('phone')->nullable();
            $table->string('email')->nullable();

            $table->string('subject')->nullable();
            $table->text('message')->nullable();

            $table->string('status')->default('new');

            $table->text('admin_comment')->nullable();

            $table->string('source_url')->nullable();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();

            $table->timestamp('processed_at')->nullable();

            $table->timestamps();

            $table->index([
                'status',
                'created_at',
            ]);

            $table->index([
                'type',
                'created_at',
            ]);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('contact_requests');
    }
};