<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * PlantillaTblOtherAssignment
     */
    public function up(): void
    {
        Schema::create('plantilla_tblOtherAssignment', function (Blueprint $table) {
            $table->id('detailed_code');
            // $table->string('detailed_code')->nullable();
            $table->string('cesno')->nullable();
            $table->string('appt_status_code')->nullable();
            $table->string('position')->nullable();
            $table->string('office')->nullable();
            $table->string('from_dt')->nullable();
            $table->string('to_dt')->nullable();
            $table->string('remarks')->nullable();
            $table->string('house_bldg')->nullable();
            $table->string('st_road')->nullable();
            $table->string('brgy_vill')->nullable();
            $table->string('city_code')->nullable();
            $table->string('contactno')->nullable();
            $table->string('email_addr')->nullable();
            $table->string('encdate')->nullable();
            $table->string('encoder')->nullable();
            $table->string('lastupd_dt')->nullable();
            $table->string('lastupd_enc')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('plantilla_tblOtherAssignment');
    }
};
