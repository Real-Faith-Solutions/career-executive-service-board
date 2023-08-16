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
        Schema::create('training_tblProvider', function (Blueprint $table) {
            $table->id('providerID');
            $table->string('provider');
            $table->string('house_bldg');
            $table->string('st_road');
            $table->string('brgy_vill');
            $table->string('city_code');
            $table->integer('contactno');
            $table->string('emailadd');
            $table->string('contactperson');
            $table->string('encoder');
            $table->string('updated_by');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('training_tblProvider');
    }
};
