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
        //work_experiences
        Schema::create('profile_tblWorkExperience', function (Blueprint $table) {
            $table->id('ctrlno');
            $table->bigInteger('cesno')->nullable();
            $table->date('from_dt')->nullable();
            $table->date('to_dt')->nullable();
            $table->string('designation')->nullable();
            $table->string('status')->nullable();
            $table->string('salary')->nullable();
            $table->string('department')->nullable();
            $table->string('remarks')->nullable();
            $table->string('encoder')->nullable();
            $table->string('encdate')->nullable();
            $table->longText('lastupd_enc')->nullable();
            $table->string('enlastupd_dtcoder')->nullable();
            // $table->string('last_updated_by')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profile_tblWorkExperience');
    }
};
