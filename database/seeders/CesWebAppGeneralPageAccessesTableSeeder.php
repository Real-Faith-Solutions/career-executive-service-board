<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\CesWebAppGeneralPageAccess;

class CesWebAppGeneralPageAccessesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $CesWebAppGeneralPageAccess = CesWebAppGeneralPageAccess::where('role_name_ces_web_app_general_page','=','Super Administrator')->get();

        if(count($CesWebAppGeneralPageAccess) === 0){

            CesWebAppGeneralPageAccess::create([
                'role_name_ces_web_app_general_page'    => 'Super Administrator',
                'ces_web_app_general_page_access'       => 'Dashboard,201 Profiling,Plantilla,Reports,Rights Management,System Utility,Competency,Database Migration',
                'encoder'                               => 'System Seeder',
                'last_updated_by'                       => 'System Seeder',
            ]);

        }
        else{

            CesWebAppGeneralPageAccess::where('role_name_ces_web_app_general_page','=','Super Administrator')->update([
                'ces_web_app_general_page_access'       => 'Dashboard,201 Profiling,Plantilla,Reports,Rights Management,System Utility,Competency,Database Migration',
                'encoder'                               => 'System Seeder',
                'last_updated_by'                       => 'System Seeder',
            ]);
        }
        
    }
}
