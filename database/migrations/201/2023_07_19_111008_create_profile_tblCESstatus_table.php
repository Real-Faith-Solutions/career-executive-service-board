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
            $table->integer('cesno');
            $table->integer('cesstat_code');
            $table->integer('acc_code');
            $table->integer('type_code');
            $table->integer('official_code');
            $table->integer('resolution_no')->nullable();
            $table->string('appointed_dt')->nullable();
            $table->timestamp('submit_dt')->nullable();
            $table->timestamp('return_dt')->nullable();
            $table->string('validator')->nullable();
            $table->string('remarks')->nullable();
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
        Schema::dropIfExists('profile_tblCESstatus');
    }
};
