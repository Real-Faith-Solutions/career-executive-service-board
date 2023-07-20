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
        Schema::create('profile_tblCESstatus', function (Blueprint $table) {
            $table->id('ctrlno');
            $table->unsignedBigInteger('cesno');
            $table->foreign('cesno')->references('cesno')->on('personal_data')->onDelete('cascade');
            $table->unsignedBigInteger('cesstat_code');
            $table->foreign('cesstat_code')->references('code')->on('profilelib_tblcesstatus')->onDelete('cascade');
            $table->unsignedBigInteger('acc_code');
            $table->foreign('acc_code')->references('code')->on('profilelib_tblcesstatusAcc')->onDelete('cascade');
            $table->unsignedBigInteger('type_code');
            $table->foreign('type_code')->references('code')->on('profilelib_tblcesstatustype')->onDelete('cascade');
            $table->unsignedBigInteger('official_code');
            $table->foreign('official_code')->references('code')->on('profilelib_tblappAuthority')->onDelete('cascade');
            $table->integer('resolution_no')->nullable();
            $table->date('appointed_dt')->nullable();
            $table->timestamp('submit_dt')->nullable();
            $table->timestamp('return_dt')->nullable();
            $table->string('validator')->nullable();
            $table->string('remarks')->nullable();
            $table->string('encoder')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profile_tblCESstatus');
    }
};
