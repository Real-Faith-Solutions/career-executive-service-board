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
        Schema::create('award_and_citations', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('cesno')->nullable();
            $table->date('date_aac')->nullable();
            $table->string('title_of_award_aac')->nullable();
            $table->string('sponsor_aac')->nullable();
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
        Schema::dropIfExists('award_and_citations');
    }
};
