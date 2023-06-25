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
        Schema::create('assessment_centers', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('cesno')->nullable();
            $table->string('an_achr_ces_we')->nullable();
            $table->date('ad_achr_ces_we')->nullable();
            $table->string('r_achr_ces_we')->nullable();
            $table->string('cfd_achr_ces_we')->nullable();
            $table->string('encoder')->nullable();
            $table->string('last_updated_by')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('assessment_centers');
    }
};
