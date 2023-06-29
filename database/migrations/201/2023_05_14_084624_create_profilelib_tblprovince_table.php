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
        Schema::create('profilelib_tblprovince', function (Blueprint $table) {
            $table->id('prov_code');
            // $table->string('prov_code')->unique();
            $table->string('reg_code')->nullable();
            $table->string('name')->nullable();
            $table->string('zipcode')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profilelib_tblprovince');
    }
};
