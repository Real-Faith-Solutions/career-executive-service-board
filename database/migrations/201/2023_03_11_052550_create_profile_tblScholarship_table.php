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
        Schema::create('profile_tblScholarship', function (Blueprint $table) {
            $table->id('ctrlno');
            $table->integer('cesno');
            // $table->foreignId('personal_data_cesno')->constrained('profile_tblMain', 'cesno');
            $table->string('type')->nullable();
            $table->string('title')->nullable();
            $table->string('sponsor')->nullable();
            $table->string('from_dt')->nullable();
            $table->string('to_dt')->nullable();
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
        Schema::dropIfExists('profile_tblScholarship');
    }
};
