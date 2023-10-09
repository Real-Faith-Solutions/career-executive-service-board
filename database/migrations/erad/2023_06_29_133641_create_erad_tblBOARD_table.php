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
        // board interview
        Schema::create('erad_tblBOARD', function (Blueprint $table) {
            $table->id('ctrlno');
            $table->foreignId('acno')->constrained('erad_tblMain', 'acno');
            $table->string('dteassign')->nullable(); // date assigned
            $table->string('dtesubmit')->nullable();  // date submit
            $table->string('intrviewer')->nullable(); // interviewer
            $table->string('dteiview')->nullable(); // date interview
            $table->string('recom')->nullable(); // recommendation
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
        Schema::dropIfExists('erad_tblBOARD');
    }
};
