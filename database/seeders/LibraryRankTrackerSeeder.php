<?php

namespace Database\Seeders;

use App\Models\Eris\LibraryRankTracker;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LibraryRankTrackerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        LibraryRankTracker::create([
            'description' => 'CESO Rank - Original',
        ]);

        LibraryRankTracker::create([
            'description' => 'CESO Rank - Adjustment',
        ]);

        LibraryRankTracker::create([
            'description' => 'CESO Rank - Promotion',
        ]);

        LibraryRankTracker::create([
            'description' => 'Clearance - Agency',
        ]);

        LibraryRankTracker::create([
            'description' => 'Clearance - CSC',
        ]);

        LibraryRankTracker::create([
            'description' => 'Clearance - Sandigan',
        ]);

        LibraryRankTracker::create([
            'description' => 'Clearance - OMB',
        ]);

        LibraryRankTracker::create([
            'description' => 'Clearance - PAGC',
        ]);

        LibraryRankTracker::create([
            'description' => 'Clearance - NBI',
        ]);

        LibraryRankTracker::create([
            'description' => 'Self-Certification',
        ]);

        LibraryRankTracker::create([
            'description' => 'Endorsement',
        ]);

        LibraryRankTracker::create([
            'description' => 'Personal Data Sheet',
        ]);

        LibraryRankTracker::create([
            'description' => 'Appointment Paper',
        ]);

        LibraryRankTracker::create([
            'description' => 'Service Record',
        ]);

        LibraryRankTracker::create([
            'description' => 'Training Certificate - SALAMIN',
        ]);
    }
}
