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
        Schema::create('approved_file', function (Blueprint $table) {
            $table->id('ctrlno');
            $table->integer('personal_data_cesno');
            // $table->unsignedBigInteger('personal_data_cesno');
            // $table->foreign('personal_data_cesno')->references('cesno')->on('profile_tblMain')->onDelete('cascade');
            $table->string('pdflink')->nullable();
            $table->string('original_pdflink')->nullable();
            $table->dateTime('request_date')->nullable();
            $table->string('requested_by')->nullable();
            $table->string('remarks')->nullable();
            $table->string('reason')->nullable();
            $table->string('encoder')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('approved_file');
    }
};
