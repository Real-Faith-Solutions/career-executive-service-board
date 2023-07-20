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
        //award_and_citations
        Schema::create('profile_tblAwards', function (Blueprint $table) {
            $table->id('ctrlno');
            // $table->bigInteger('cesno')->nullable();
            $table->unsignedBigInteger('personal_data_cesno');
            $table->foreign('personal_data_cesno')->references('cesno')->on('profile_tblMain')->onDelete('cascade');
            $table->string('awards')->nullable();
            $table->string('sponsor')->nullable();
            $table->date('date')->nullable();
            // $table->string('award_dt')->nullable();
            // $table->string('aw_dt')->nullable();
            $table->string('encoder')->nullable();
            $table->string('updated_by')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profile_tblAwards');
    }
};
