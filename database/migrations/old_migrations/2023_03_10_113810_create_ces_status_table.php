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
        Schema::create('ces_statuses', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('cesno')->nullable();
            $table->string('cs_cs_ces_we')->nullable();
            $table->string('at_cs_ces_we')->nullable();
            $table->string('st_cs_ces_we')->nullable();
            $table->string('aa_cs_ces_we')->nullable();
            $table->string('rn_cs_ces_we')->nullable();
            $table->date('da_cs_ces_we')->nullable();
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
        Schema::dropIfExists('ces_statuses');
    }
};
