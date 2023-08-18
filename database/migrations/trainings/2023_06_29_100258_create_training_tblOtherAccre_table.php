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
            $table->foreignId('personal_data_cesno')->constrained('profile_tblMain', 'cesno');
            $table->string('training');
            $table->string('training_category')->nullable();
            $table->string('no_hours');
            $table->string('sponsor');
            $table->string('venue')->nullable();
            $table->date('from_dt');
            $table->date('to_dt');
            $table->string('specialization');
            $table->string('encoder')->nullable();
            $table->string('updated_by')->nullable();
            // $table->string('providerID');
            $table->foreignId('providerID')->constrained('training_tblProvider', 'providerID')->nullable();
            $table->timestamps();
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
