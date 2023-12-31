<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Database\Seeders\Plantilla\ApptStatusSeeder;
use Database\Seeders\Plantilla\DepartmentAgencyTypeSeeder;
use Database\Seeders\Plantilla\SectorManagerSeeder;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{

    public function run(): void
    {

        // 201 and eris
        \App\Models\ProfileLibTblEducDegree::factory(10)->create();
        \App\Models\ProfileLibTblEducSchool::factory(10)->create();
        \App\Models\ProfileLibTblEducMajor::factory(10)->create();
        \App\Models\ProfileLibTblExpertiseSpec::factory(10)->create();
        \App\Models\ProfileLibTblLanguageRef::factory(10)->create();
        \App\Models\PersonalData::factory(5000)->create();
        \App\Models\ProfileLibTblExamRef::factory(20)->create();
        // \App\Models\ProfileLibTblCesStatus::factory(10)->create();
        // \App\Models\ProfileLibTblCesStatusAcc::factory(10)->create();
        // \App\Models\ProfileLibTblCesStatusType::factory(10)->create();
        // \App\Models\ProfileLibTblAppAuthority::factory(10)->create();
        \App\Models\ProfileLibCities::factory(10)->create();
        \App\Models\TrainingLibCategory::factory(10)->create();
        \App\Models\TrainingSecretariat::factory(10)->create();
        \App\Models\CompetencyTrainingProvider::factory(100)->create();

        // plantilla
        \App\Models\Plantilla\PositionLevelLibrary::factory(2)->create();

        $this->call([
            PermissionsTableSeeder::class,
            RolesTableSeeder::class,
            IndigenousGroup::class,
            PWD::class,
            GenderByChoice::class,
            GenderByBirth::class,
            NameExtension::class,
            CivilStatus::class,
            Title::class,
            RecordStatus::class,
            Religion::class,
            ProfileLibTblCesStatusSeeder::class,
            ProfileLibTblCesStatusTypeSeeder::class,
            ProfileLibTblCesStatusAccSeeder::class,
            ProfileLibTblAppAuthoritySeeder::class,
            profilelib_tblCaseNatureSeeder::class,
            profilelib_tblCaseStatusSeeder::class,
            LibraryRankTrackerSeeder::class,
            ProfileLibTblExpertiseSpecSeeder::class,
            ProfileLibTblEducSchoolSeeder::class,
            ProfileLibTblEducMajorSeeder::class,
            ProfileLibTblEducDegreeSeeder::class,
            ProfileLibTblExamRefSeeder::class,
            ProfileLibTblLanguageRefSeeder::class,
            ProfileLibTblExpertiseGenSeeder::class,
            TrainingLibCategorySeeder::class,
            // ErisTblMainSeeder::class,
            ScholarshipSeeder::class,
            // WrittenExamSeeder::class,
            DefaultAccounts::class,
            // plantilla
            // SectorManagerSeeder::class,
            // AgencyLocationSeeder::class,
            // DepartmentAgencyTypeSeeder::class,
            // ApptStatusSeeder::class,
        ]);
    }
}
