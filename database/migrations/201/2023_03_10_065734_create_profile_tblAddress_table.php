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
        //addresses
        Schema::create('profile_tblAddress', function (Blueprint $table) {
            $table->id('ctrlno');
            $table->bigInteger('cesno')->nullable();
            $table->string('type')->nullable();
            $table->string('floor_bldg')->nullable();
            $table->string('no_street')->nullable();
            $table->string('region')->nullable();
            $table->string('brgy_or_district')->nullable();
            $table->string('city_or_municipality')->nullable();
            $table->string('zip_code')->nullable();
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
        Schema::dropIfExists('profile_tblAddress');
    }
};
