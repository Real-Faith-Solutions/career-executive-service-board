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
        Schema::create('erad_tblranktracker', function (Blueprint $table) {
            $table->id('acno');
            $table->integer('r_catid');
            $table->integer('r_ctrlno');
            $table->string('description');
            $table->string('remarks');
            $table->string('submit_dt');
            $table->string('encdate');
            $table->string('encoder');
            $table->integer('ctrlno');
            $table->string('cesstatus');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('erad_tblranktracker');
    }
};
