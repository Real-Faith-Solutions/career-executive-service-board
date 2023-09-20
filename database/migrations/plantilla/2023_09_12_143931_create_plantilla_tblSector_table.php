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
        Schema::create('plantilla_tblSector', function (Blueprint $table) {
            $table->id('sectorid');
            $table->string('title');
            $table->text('description');
            $table->string('encoder');
            $table->softDeletes();
            // $table->timestamps();
            $table->timestamp('encdate')->useCurrent();
            $table->timestamp('lastupd_date')->useCurrent();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('plantilla_tblSector');
    }
};