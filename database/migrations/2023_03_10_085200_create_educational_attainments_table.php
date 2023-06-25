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
        Schema::create('educational_attainments', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('cesno')->nullable();
            $table->string('level_ea')->nullable();
            $table->string('school_ea')->nullable();
            $table->string('degree_ea')->nullable();
            $table->string('date_grad_ea')->nullable();
            $table->string('ms_ea')->nullable();
            $table->string('school_type_ea')->nullable();
            $table->date('date_f_ea')->nullable();
            $table->date('date_t_ea')->nullable();
            $table->string('hlu_ea')->nullable();
            $table->string('ahr_ea')->nullable();
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
        Schema::dropIfExists('educational_attainments');
    }
};
