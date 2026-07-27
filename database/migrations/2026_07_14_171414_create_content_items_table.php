<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('content_items', function (Blueprint $table) {
            $table->id();

            $table->foreignId('content_category_id')
                ->constrained()
                ->cascadeOnUpdate()
                ->restrictOnDelete();

            $table->string('title');
            $table->string('slug')->unique();

            $table->string('image')->nullable();

            $table->text('short_description')->nullable();
            $table->longText('content')->nullable();

            $table->string('button_text', 100)->nullable();
            $table->string('button_url')->nullable();

            $table->boolean('is_active')->default(true);
            $table->boolean('show_on_home')->default(false);

            $table->unsignedInteger('sort_order')->default(0);

            $table->dateTime('published_at')->nullable();
            $table->dateTime('starts_at')->nullable();
            $table->dateTime('ends_at')->nullable();

            $table->string('seo_title')->nullable();
            $table->text('seo_description')->nullable();

            $table->timestamps();

            $table->index(
                [
                    'content_category_id',
                    'is_active',
                    'show_on_home',
                    'sort_order',
                ],
                'content_items_home_idx'
            );
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('content_items');
    }
};