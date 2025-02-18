<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('form_elements', function (Blueprint $table) {
            $table->text('details')->change();  // Change to TEXT type
        });
    }
    
    public function down()
    {
        Schema::table('form_elements', function (Blueprint $table) {
            $table->json('details')->change();  // Revert to JSON type if needed
        });
    }    
};
