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
            $table->foreignId('cesno')->constrained('profile_tblMain', 'cesno');
            $table->string('training')->nullable();
            $table->string('training_category')->nullable();
            $table->string('no_hours')->nullable();
            $table->string('sponsor')->nullable();
            $table->string('venue')->nullable();
            $table->date('from_dt')->nullable();
            $table->date('to_dt')->nullable();
            $table->string('specialization')->nullable();
            $table->string('encoder')->nullable();
            $table->string('lastupd_enc')->nullable();
            $table->foreignId('providerID')->constrained('training_tblProvider', 'providerID')->nullable();
            $table->timestamp('encdate')->useCurrent();
            $table->timestamp('lastupd_dt')->useCurrent();
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
