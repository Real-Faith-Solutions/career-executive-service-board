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
        Schema::create('plantilla_motherdept', function (Blueprint $table) {
            $table->id('deptid');
            $table->string('title')->nullable();
            $table->string('encoder')->nullable();
            $table->string('updated_by')->nullable();
            $table->integer('is_national_government')->nullable(); // new 
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('plantilla_motherdept');
    }
};
