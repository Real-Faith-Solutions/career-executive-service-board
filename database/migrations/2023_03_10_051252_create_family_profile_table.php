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
        Schema::create('family_profiles', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('cesno')->unique();
            $table->string('fn_lastname_fp')->nullable();
            $table->string('fn_first_fp')->nullable();
            $table->string('fn_middlename_fp')->nullable();
            $table->string('fn_ne_fp')->nullable();
            $table->string('mn_lastname_fp')->nullable();
            $table->string('mn_first_fp')->nullable();
            $table->string('mn_middlename_fp')->nullable();
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
        Schema::dropIfExists('family_profiles');
    }
};
