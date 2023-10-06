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
            $table->string('title')->nullable();
            $table->text('description')->nullable();
            $table->string('encoder')->nullable();
            $table->softDeletes();
            $table->timestamp('encdate')->nullable()->useCurrent();
            $table->timestamp('lastupd_date')->nullable()->useCurrent();
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
