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
        //health_records
        Schema::create('profile_tblHealthRecord', function (Blueprint $table) {
            $table->id('ctrlno');
            $table->bigInteger('cesno')->nullable();
            $table->string('marks')->nullable();
            $table->string('handicap')->nullable();
            $table->string('illness')->nullable();
            $table->string('ill_dt')->nullable();
            $table->string('encoder')->nullable();
            $table->string('encdate')->nullable();
            $table->string('lastupd_enc')->nullable();
            $table->string('lastupd_dt')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profile_tblHealthRecord');
    }
};
