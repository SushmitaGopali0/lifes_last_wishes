<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('post', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->longText('post_content');
            $table->text('excerpt');
            $table->text('category');
            $table->text('tags');
            $table->string('image');
            $table->text('meta_description')->nullable();
            $table->text('meta_keywords')->nullable();
            $table->text('seo_title')->nullable();
            $table->string('status')->default('draft');
            $table->boolean('is_featured')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('post');
    }
};
