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
        // assessment center
        Schema::create('erad_tblAC', function (Blueprint $table) {
            $table->id('ctrlno');
            // $table->foreignId('acno')->constrained('erad_tblMain', 'acno');
            $table->integer('acno')->nullable();
            $table->string('acdate')->nullable(); // assessment center date
            $table->integer('numtakes')->nullable(); // number of takes
            $table->string('docdate')->nullable(); // document date
            $table->string('remarks')->nullable();
            $table->string('competencies_d_o')->nullable();
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
        Schema::dropIfExists('erad_tblAC');
    }
};
