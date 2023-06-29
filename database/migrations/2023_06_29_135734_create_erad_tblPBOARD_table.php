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
        Schema::create('erad_tblPBOARD', function (Blueprint $table) {
            $table->id('acno');
            $table->string('dteassign');
            $table->string('dtesubmit');
            $table->string('intrviewer');
            $table->string('dteiview');
            $table->string('recom');
            $table->string('encoder');  
            $table->string('encdate');
            $table->integer('ctrlno');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('erad_tblPBOARD');
    }
};
