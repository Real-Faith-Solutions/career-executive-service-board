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
        Schema::create('scholarships', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('cesno')->nullable();
            $table->date('date_f_scholarships')->nullable();
            $table->date('date_t_scholarships')->nullable();
            $table->string('scholar_type_scholarships')->nullable();
            $table->string('title_scholarships')->nullable();
            $table->string('sponsor_scholarships')->nullable();
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
        Schema::dropIfExists('scholarships');
    }
};
