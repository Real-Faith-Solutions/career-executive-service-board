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
        Schema::create('profile_cesstatus', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('ctrlno')->unique();
            $table->bigInteger('cesno');
            $table->bigInteger('cesstat_code')->nullable();
            $table->bigInteger('acc_code')->nullable();
            $table->bigInteger('type_code')->nullable();
            $table->bigInteger('official_code')->nullable();
            $table->string('resolution_no')->nullable();
            $table->timestamp('appointed_dt')->nullable();
            $table->timestamp('submit_dt')->nullable();
            $table->timestamp('return_dt')->nullable();
            $table->string('validator')->nullable();
            $table->string('remarks')->nullable();
            $table->string('encoder')->nullable();
            $table->timestamp('encdate')->nullable();
            $table->string('lastupd_enc')->nullable();
            $table->timestamp('lastupd_dt')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profile_cesstatus');
    }
};
