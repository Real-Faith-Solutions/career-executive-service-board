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
        Schema::create('training_secretariat', function (Blueprint $table) {
            $table->id('ctrlno');
            $table->string('description');
            $table->string('encoder');
            $table->timestamp('encdate');
            $table->timestamp('update_time');
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('training_secretariat');
    }
};
