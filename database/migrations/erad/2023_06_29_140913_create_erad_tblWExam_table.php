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
        Schema::create('erad_tblWExam', function (Blueprint $table) {
            $table->id('ctrlno');
            $table->integer('acno');
            $table->string('we_date')->nullable(); // written exam date
            $table->string('we_location')->nullable(); // written exam location
            $table->string('we_rating')->nullable(); // written exam rating
            $table->string('we_remarks')->nullable(); // written exam remarks
            $table->integer('numtakes')->nullable(); // number of takes
            $table->string('encoder')->nullable();
            $table->timestamp('encdate')->nullable()->useCurrent();
            $table->timestamp('updated_at')->nullable()->useCurrent();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('erad_tblWExam');
    }
};
