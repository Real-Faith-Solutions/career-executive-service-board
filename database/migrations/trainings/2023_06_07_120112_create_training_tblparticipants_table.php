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
        //training_tblparticipants
        Schema::create('training_tblparticipants', function (Blueprint $table) {
            $table->id('pid');
            $table->foreignId('cesno')->constrained('profile_tblMain', 'cesno');
            $table->foreignId('sessionid')->constrained('training_tblSessions', 'sessionid');
            $table->string('status')->nullable();
            $table->string('remarks')->nullable();
            $table->integer('no_hours')->nullable();
            $table->string('payment')->nullable();
            $table->string('encoder')->nullable();
            $table->string('updated_by')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('training_tblparticipants');
    }
};
