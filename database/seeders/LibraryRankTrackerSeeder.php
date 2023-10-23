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
            'catid' => 1,
            'description' => 'CESO Rank - Original',
        ]);

        LibraryRankTracker::create([
            'catid' => 1,
            'description' => 'CESO Rank - Adjustment',
        ]);

        LibraryRankTracker::create([
            'catid' => 1,
            'description' => 'CESO Rank - Promotion',
        ]);

        LibraryRankTracker::create([
            'catid' => 1,
            'description' => 'Clearance - Agency',
        ]);

        LibraryRankTracker::create([
            'catid' => 1,
            'description' => 'Clearance - CSC',
        ]);

        LibraryRankTracker::create([
            'catid' => 1,
            'description' => 'Clearance - Sandigan',
        ]);

        LibraryRankTracker::create([
            'catid' => 1,
            'description' => 'Clearance - OMB',
        ]);

        LibraryRankTracker::create([
            'catid' => 1,
            'description' => 'Clearance - PAGC',
        ]);

        LibraryRankTracker::create([
            'catid' => 1,
            'description' => 'Clearance - NBI',
        ]);

        LibraryRankTracker::create([
            'catid' => 1,
            'description' => 'Self-Certification',
        ]);

        LibraryRankTracker::create([
            'catid' => 1,
            'description' => 'Endorsement',
        ]);

        LibraryRankTracker::create([
            'catid' => 1,
            'description' => 'Personal Data Sheet',
        ]);

        LibraryRankTracker::create([
            'catid' => 1,
            'description' => 'Appointment Paper',
        ]);

        LibraryRankTracker::create([
            'catid' => 1,
            'description' => 'Service Record',
        ]);

        LibraryRankTracker::create([
            'catid' => 1,
            'description' => 'Training Certificate - SALAMIN',
        ]);
    }
}
