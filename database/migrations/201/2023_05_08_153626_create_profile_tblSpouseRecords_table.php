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
        Schema::create('profile_tblSpouseRecords', function (Blueprint $table) {
            $table->id('ctrlno');
            $table->foreignId('personal_data_cesno')->constrained('profile_tblMain', 'cesno');
            $table->string('last_name')->nullable();
            $table->string('first_name')->nullable();
            $table->string('middle_name')->nullable();
            $table->string('name_extension')->nullable();
            $table->string('occupation')->nullable();
            $table->string('employer_business_name')->nullable();
            $table->string('employer_business_address')->nullable();
            $table->string('employer_business_telephone')->nullable();
            $table->string('encoder')->nullable();
            $table->string('updated_by')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profile_tblSpouseRecords');
    }
};
