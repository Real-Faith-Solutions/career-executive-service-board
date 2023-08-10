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
        Schema::create('profile_tblScholarship', function (Blueprint $table) {
            $table->id('ctrlno');
            $table->foreignId('personal_data_cesno')->constrained('profile_tblMain', 'cesno');
            $table->string('type')->nullable();
            $table->string('title')->nullable();
            $table->string('sponsor')->nullable();
            $table->string('inclusive_date_from')->nullable();
            $table->string('inclusive_date_to')->nullable();
            $table->string('encoder')->nullable();
            $table->string('updated_by')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profile_tblScholarship');
    }
};
