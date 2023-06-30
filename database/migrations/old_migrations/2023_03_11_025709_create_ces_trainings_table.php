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
        Schema::create('ces_trainings', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('cesno')->nullable();
            $table->string('s_title_ces_trainings')->nullable();
            $table->string('s_no_ces_trainings')->nullable();
            $table->string('training_category_ces_trainings')->nullable();
            $table->string('fos_ces_trainings')->nullable();
            $table->string('venue_ces_trainings')->nullable();
            $table->string('noh_ces_trainings')->nullable();
            $table->string('barrio_ces_trainings')->nullable();
            $table->string('rs_ces_trainings')->nullable();
            $table->string('sd_ces_trainings')->nullable();
            $table->string('training_status_ces_trainings')->nullable();
            $table->longText('remarks_ces_trainings')->nullable();
            $table->date('date_f_ces_trainings')->nullable();
            $table->date('date_t_ces_trainings')->nullable();
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
        Schema::dropIfExists('ces_trainings');
    }
};
