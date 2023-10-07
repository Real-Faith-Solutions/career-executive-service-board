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
        Schema::create('plantilla_tblOtherAssignment', function (Blueprint $table) {
            $table->id('detailed_code');
            $table->integer('cesno')->nullable(); // FK
            $table->integer('appt_status_code')->nullable(); // FK
            $table->string('position')->nullable();
            $table->string('office')->nullable();
            $table->string('from_dt')->nullable();
            $table->string('to_dt')->nullable();
            $table->string('remarks')->nullable();
            $table->string('house_bldg')->nullable();
            $table->string('st_road')->nullable();
            $table->string('brgy_vill')->nullable();
            $table->integer('city_code')->nullable(); // FK
            $table->string('contactno')->nullable();
            $table->string('email_addr')->nullable();
            $table->string('encoder')->nullable();
            $table->string('lastupd_enc')->nullable();
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
        Schema::dropIfExists('plantilla_tblOtherAssignment');
    }
};
