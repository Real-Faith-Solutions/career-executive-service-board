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
        Schema::create('device_verification', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_ctrlno');
            $table->foreign('user_ctrlno')->references('ctrlno')->on('users')->onDelete('cascade');
            $table->string('confirmation_code');
            $table->string('device_id')->unique();
            $table->boolean('verified')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('device_verification');
    }
};
