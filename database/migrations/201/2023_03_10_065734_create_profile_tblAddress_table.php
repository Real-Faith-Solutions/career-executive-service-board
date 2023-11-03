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
            $table->integer('personal_data_cesno')->nullable();
            $table->integer('cesno')->nullable(); //legacy
            $table->string('catid')->nullable(); //legacy
            // $table->unsignedBigInteger('personal_data_cesno');
            // $table->foreign('personal_data_cesno')->references('cesno')->on('profile_tblMain')->onDelete('cascade');
            $table->string('type')->nullable();
            $table->string('region_code')->nullable();
            $table->string('region_name')->nullable();
            $table->string('city_or_municipality_code')->nullable();
            $table->string('city_or_municipality_name')->nullable();
            $table->string('brgy_code')->nullable();
            $table->string('brgy_name')->nullable();
            $table->string('zip_code')->nullable();
            $table->string('street_lot_bldg_floor')->nullable();
            $table->string('house_bldg')->nullable(); //legacy
            $table->string('st_road')->nullable(); //legacy
            $table->string('brgy_vill')->nullable(); //legacy
            $table->string('city_code')->nullable(); //legacy
            $table->string('contactno')->nullable(); //legacy
            $table->string('encoder')->nullable();
            $table->string('last_updated_by')->nullable();
            $table->string('encdate')->nullable(); //legacy
            $table->string('lastupd_enc')->nullable(); //legacy
            $table->string('lastupd_dt')->nullable(); //legacy
            $table->softDeletes();
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