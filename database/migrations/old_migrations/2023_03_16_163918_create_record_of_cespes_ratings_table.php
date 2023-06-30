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
        Schema::create('record_of_cespes_ratings', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('cesno')->nullable();
            $table->date('date_from_rocr')->nullable();
            $table->date('date_to_rocr')->nullable();
            $table->string('rating_rocr')->nullable();
            $table->string('status_rocr')->nullable();
            $table->longText('remarks_rocr')->nullable();
            $table->string('pdf_rating_certificate_rocr')->nullable();
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
        Schema::dropIfExists('record_of_cespes_ratings');
    }
};
