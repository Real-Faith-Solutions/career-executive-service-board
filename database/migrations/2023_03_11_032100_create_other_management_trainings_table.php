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
        Schema::create('other_management_trainings', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('cesno')->nullable();
            $table->date('date_f_onat')->nullable();
            $table->date('date_t_onat')->nullable();
            $table->string('title_traning_onat')->nullable();
            $table->string('training_category_onat')->nullable();
            $table->string('expertise_fos_onat')->nullable();
            $table->string('sponsor_tp_onat')->nullable();
            $table->string('vanue_onat')->nullable();
            $table->string('no_training_hours_omt')->nullable();
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
        Schema::dropIfExists('other_management_trainings');
    }
};
