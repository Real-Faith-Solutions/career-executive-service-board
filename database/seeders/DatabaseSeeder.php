<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        // \App\Models\ProfileLibTblEducDegree::factory(10)->create();
        // \App\Models\ProfileLibTblEducSchool::factory(10)->create();
        // \App\Models\ProfileLibTblEducMajor::factory(10)->create();
        // \App\Models\ProfileLibTblExpertiseSpec::factory(10)->create();
        // \App\Models\ProfileLibTblLanguageRef::factory(10)->create();
        \App\Models\PersonalData::factory(50)->create();
        // \App\Models\ProfileLibTblExamRef::factory(10)->create();
        // \App\Models\ProfileLibTblCesStatus::factory(10)->create();
        // \App\Models\ProfileLibTblCesStatusAcc::factory(10)->create();
        // \App\Models\ProfileLibTblCesStatusType::factory(10)->create();
        // \App\Models\ProfileLibTblAppAuthority::factory(10)->create();
        \App\Models\ProfileLibCities::factory(10)->create();
        \App\Models\TrainingLibCategory::factory(10)->create(); 
        \App\Models\TrainingSecretariat::factory(10)->create(); 

        $this->call([
            PermissionsTableSeeder::class,
            RolesTableSeeder::class,
            // UsersTableSeeder::class,
            DefaultAccounts::class,
            // CesWebAppGeneralPageAccessesTableSeeder::class,
            // ProfileData::class,
            // ProfileAddress::class,
            IndigenousGroup::class,
            PWD::class,
            GenderByChoice::class,
            GenderByBirth::class,
            NameExtension::class,
            CivilStatus::class,
            Title::class,
            RecordStatus::class,
            Religion::class,
            SectorManager::class,
            ProfileLibTblCesStatusTypeSeeder::class,
            ProfileLibTblCesStatusAccSeeder::class,
            ProfileLibTblCesStatusSeeder::class,
            ProfileLibTblAppAuthoritySeeder::class,
            ProfileLibTblExpertiseSpecSeeder::class,
            ProfileLibTblEducSchoolSeeder::class,
            ProfileLibTblEducMajorSeeder::class,
            ProfileLibTblEducDegreeSeeder::class,
            ProfileLibTblExamRefSeeder::class,
            ProfileLibTblLanguageRefSeeder::class,
        ]);

    }
}
