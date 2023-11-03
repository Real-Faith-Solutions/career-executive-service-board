<?php

namespace App\Models\Eris;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LibraryRankTracker extends Model
{
    use HasFactory, SoftDeletes;

    protected $primaryKey = 'ctrlno';

    protected $table = "erad_libRankTracker";

    protected $fillable = [

        'catid',
        'description',

    ];

    public function getRankTrackerCatId($description)
    {
        $rankTrackerCatId = LibraryRankTracker::where('description', $description)->value('catid');
        
        return $rankTrackerCatId;
    }

    public function getRankTrackerControlNo($description)
    {
        $rankTrackerControlNo = LibraryRankTracker::where('description', $description)->value('ctrlno');

        return $rankTrackerControlNo;
    }
}
