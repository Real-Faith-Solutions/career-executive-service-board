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
        // rapid validation
        Schema::create('erad_tblRVP', function (Blueprint $table) {
            $table->id('ctrlno');
            $table->foreignId('acno')->constrained('erad_tblMain', 'acno');
            $table->date('dteassign')->nullable(); // date assign
            $table->date('dtesubmit')->nullable(); // date submnit
            $table->string('validator')->nullable();
            $table->string('recom')->nullable(); // recommendation
            $table->string('remarks')->nullable();
            $table->string('encoder')->nullable();
            $table->timestamp('encdate')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('erad_tblRVP');
    }
};
