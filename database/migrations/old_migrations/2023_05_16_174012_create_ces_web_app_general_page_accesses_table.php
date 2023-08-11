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
        Schema::create('ces_web_app_general_page_accesses', function (Blueprint $table) {
            $table->id();
            $table->string('role_name_ces_web_app_general_page')->unique();
            $table->string('ces_web_app_general_page_access')->nullable();
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
        Schema::dropIfExists('ces_web_app_general_page_accesses');
    }
};
