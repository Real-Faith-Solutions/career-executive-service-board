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
        Schema::create('mailing_addresses', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('cesno')->nullable();
            $table->string('fb_ma')->nullable();
            $table->string('ns_ma')->nullable();
            $table->string('bd_ma')->nullable();
            $table->string('cm_ma')->nullable();
            $table->string('zc_ma')->nullable();
            $table->string('oea_ma')->nullable();
            $table->string('mobileno1_ma')->nullable();
            $table->string('telno1_ma')->nullable();
            $table->string('mobileno2_ma')->nullable();
            $table->string('encoder')->nullable();
            $table->string('last_updated_by')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mailing_addresses');
    }
};
