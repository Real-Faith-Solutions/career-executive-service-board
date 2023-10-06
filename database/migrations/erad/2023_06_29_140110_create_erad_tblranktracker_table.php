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
        // rank tracker
        Schema::create('erad_tblranktracker', function (Blueprint $table) {
            $table->id('ctrlno');
            $table->foreignId('acno')->constrained('erad_tblMain', 'acno');
            $table->integer('r_catid')->nullable();
            $table->integer('r_ctrlno')->nullable();
            $table->string('description')->nullable();
            $table->string('remarks')->nullable();
            $table->date('submit_dt')->nullable();
            $table->string('cesstatus')->nullable();
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
        Schema::dropIfExists('erad_tblranktracker');
    }
};
