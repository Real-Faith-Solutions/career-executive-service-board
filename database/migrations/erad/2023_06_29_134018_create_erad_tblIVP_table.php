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
        // in depth validation
        Schema::create('erad_tblIVP', function (Blueprint $table) {
            $table->id('ctrlno');
            // $table->foreignId('acno')->constrained('erad_tblMain', 'acno');
            $table->integer('acno')->nullable();
            $table->string('dteassign')->nullable(); // date assign
            $table->string('dtesubmit')->nullable(); // date submit
            $table->string('validator')->nullable();
            $table->string('recom')->nullable(); // recommendation
            $table->string('remarks')->nullable();
            $table->string('dtedefer')->nullable(); // date defer
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
        Schema::dropIfExists('erad_tblIVP');
    }
};
