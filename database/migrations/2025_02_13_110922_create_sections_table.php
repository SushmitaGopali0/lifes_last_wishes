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
        Schema::create('sections', function (Blueprint $table) {
            $table->id(); // This creates a BIGINT UNSIGNED column
            $table->unsignedBigInteger('parent_id')->nullable(); // Change from unsignedInteger to unsignedBigInteger
            $table->text('title');
            $table->text('slug');
            $table->text('body');
            $table->enum('status', ['PUBLISHED', 'DRAFT'])->default('DRAFT');
            $table->timestamps();
        
            // Foreign key reference to the same table
            $table->foreign('parent_id')->references('id')->on('sections')->onDelete('cascade');
        });
        
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sections');
    }
};
