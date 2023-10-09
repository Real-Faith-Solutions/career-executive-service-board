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
        Schema::create('training_tblOtherAccre', function (Blueprint $table) {
            $table->id('ctrlno');
            $table->integer('cesno');
            // $table->foreignId('cesno')->constrained('profile_tblMain', 'cesno');
            $table->string('training')->nullable();
            $table->string('training_category')->nullable();
            $table->string('no_hours')->nullable();
            $table->string('sponsor')->nullable();
            $table->string('venue')->nullable();
            $table->string('from_dt')->nullable();
            $table->string('to_dt')->nullable();
            $table->string('specialization')->nullable();
            $table->string('encoder')->nullable();
            $table->string('lastupd_enc')->nullable();
            $table->integer('providerID');
            // $table->foreignId('providerID')->constrained('training_tblProvider', 'providerID')->nullable();
            $table->timestamp('encdate')->nullable()->useCurrent();
            $table->timestamp('lastupd_dt')->nullable()->useCurrent();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('training_tblOtherAccre');
    }
};
