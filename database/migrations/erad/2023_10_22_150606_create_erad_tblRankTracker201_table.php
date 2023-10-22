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
        Schema::create('erad_tblRankTracker201', function (Blueprint $table) {
            $table->id('ctrlno');
            $table->integer('cesno')->nullable();
            $table->integer('r_catid')->nullable();
            $table->integer('r_ctrlno')->nullable();
            $table->string('description')->nullable();
            $table->string('remarks')->nullable();
            $table->dateTime('submit_dt')->nullable();
            $table->string('encoder')->nullable();
            $table->string('lastupd_enc')->nullable();
            $table->timestamp('encdate')->nullable()->useCurrent();
            $table->timestamp('lastupd_dt')->nullable()->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('erad_tblRankTracker201');
    }
};
