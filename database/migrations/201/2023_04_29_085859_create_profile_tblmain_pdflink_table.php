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
        //pdf_links
        Schema::create('profile_tblmain_pdflink', function (Blueprint $table) {
            $table->id('ctrlno');
            $table->integer('cesno')->nullable();
            // $table->unsignedBigInteger('personal_data_cesno');
            // $table->foreign('personal_data_cesno')->references('cesno')->on('profile_tblMain')->onDelete('cascade');
            $table->string('pdflink')->nullable();
            $table->string('original_pdflink')->nullable();
            $table->dateTime('request_date')->nullable();
            $table->string('requested_by')->nullable();
            $table->string('encoder')->nullable();
            $table->string('remarks')->nullable();
            $table->timestamp('encdate')->useCurrent()->nullable();
            $table->timestamp('updated_at')->useCurrent()->nullable();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profile_tblmain_pdflink');
    }
};
