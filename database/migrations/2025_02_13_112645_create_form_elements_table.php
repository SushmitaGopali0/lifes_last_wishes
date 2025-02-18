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
        Schema::create('form_elements', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('form_group_id');
            $table->foreign('form_group_id')->references('id')->on('form_groups')->onDelete('cascade');
            $table->enum('type', ['TEXT', 'TEXTAREA', 'CHECKBOX', 'RADIO', 'DROPDOWN', 'MULTIROWS'])->default('TEXT');
            $table->string('label');
            $table->string('pdf_label')->nullable();
            $table->boolean('show_in_pdf');
            $table->json('details');
            $table->unsignedTinyInteger('order');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('form_elements');
    }
};
