<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class FamilyProfile extends Model
{
    use HasFactory;
    
    // protected $guarded = [];

    protected $table = "family_profiles";

    protected $fillable = [
        'cesno',
        'father_last_name',
        'father_first_name',
        'father_middle_name',
        'suffix',
        'mother_last_name',
        'mother_first_name',
        'mother_middle_name',
        'encoder',
    ];

    public function familyPersonalData(): BelongsTo
    {
        return $this->belongsTo(PersonalData::class);
    }


}
