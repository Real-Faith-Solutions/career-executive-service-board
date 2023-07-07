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
        //scholarships
        Schema::create('profile_tblScholarship', function (Blueprint $table) {
            $table->id('ctrlno');
            $table->bigInteger('cesno');
            $table->string('type');
            $table->string('title');
            $table->string('sponsor');
            $table->string('inclusive_date_from');
            $table->string('inclusive_date_to');
            $table->string('encoder');
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
