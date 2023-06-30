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
        Schema::table('personal_data', function (Blueprint $table) {
            $table->string('acno')->nullable();
            $table->longText('remarks')->nullable();
            $table->text('mailingaddr')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('personal_data', function (Blueprint $table) {
            //
        });
    }
};
