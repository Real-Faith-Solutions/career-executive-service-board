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
        //affiliations
        Schema::create('profile_tblAffiliations', function (Blueprint $table) {
            $table->id('ctrlno');
            $table->integer('cesno');
            // $table->foreign('cesno')->references('cesno')->on('profile_tblMain')->onDelete('cascade');
            $table->string('organization')->nullable();
            $table->string('position')->nullable();
            $table->date('from_dt')->nullable();
            $table->date('to_dt')->nullable();
            $table->string('encoder')->nullable();
            $table->string('lastupd_enc')->nullable();
            $table->timestamp('encdate')->useCurrent();
            $table->timestamp('lastupd_dt')->useCurrent();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profile_tblAffiliations');
    }
};
