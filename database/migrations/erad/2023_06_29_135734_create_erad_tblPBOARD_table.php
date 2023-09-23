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
        // panel board interview
        Schema::create('erad_tblPBOARD', function (Blueprint $table) {
            $table->id('ctrlno');
            $table->foreignId('acno')->constrained('erad_tblMain', 'acno');
            $table->date('dteassign')->nullable(); // date assigned
            $table->date('dtesubmit')->nullable(); // date submit
            $table->string('intrviewer')->nullable(); // interviewer
            $table->date('dteiview')->nullable(); // date interview
            $table->string('recom')->nullable(); // recommendation
            $table->string('encoder')->nullable();  
            $table->timestamp('encdate');
            $table->timestamp('updated_at');
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('erad_tblPBOARD');
    }
};
