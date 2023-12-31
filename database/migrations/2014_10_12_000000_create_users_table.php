<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id('ctrlno');
            $table->integer('personal_data_cesno');
            // $table->unsignedBigInteger('personal_data_cesno');
            // $table->foreign('personal_data_cesno')->references('cesno')->on('profile_tblMain')->onDelete('cascade');
            // $table->string('contact_no')->unique()->nullable();
            $table->string('email')->unique();
            $table->string('password');
            $table->boolean('two_factor')->default(false);
            $table->string('is_active')->nullable();
            $table->integer('attemps')->nullable();
            $table->timestamp('suspension')->nullable();
            $table->string('encoder')->nullable();
            $table->string('last_updated_by')->nullable();
            $table->string('default_password_change')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('users');
    }

};
