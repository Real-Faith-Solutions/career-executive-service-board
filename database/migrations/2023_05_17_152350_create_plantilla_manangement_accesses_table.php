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
        Schema::create('plantilla_manangement_accesses', function (Blueprint $table) {
            $table->id();
            $table->string('role_name_plantilla_manangement')->unique();
            $table->text('plantilla_manangement_page_access')->nullable();
            $table->text('plantilla_management_main_screen_rights')->nullable();
            $table->text('sector_manager_rights')->nullable();
            $table->text('department_agency_manager_rights')->nullable();
            $table->text('agency_location_manager_rights')->nullable();
            $table->text('office_manager_rights')->nullable();
            $table->text('plantilla_position_manager_rights')->nullable();
            $table->text('plantilla_position_classification_manager_rights')->nullable();
            $table->text('appointee_occupant_manager_rights')->nullable();
            $table->text('plantilla_appointee_occupant_browser_rights')->nullable();
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
        Schema::dropIfExists('plantilla_manangement_accesses');
    }
};
