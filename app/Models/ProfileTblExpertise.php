<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProfileTblExpertise extends Model
{
    use HasFactory,SoftDeletes;

    protected $primaryKey = 'ctrlno';

    protected $table = "profile_tblExpertise";

    protected $fillable = [

        'personal_data_cesno',
        'specialization_code',
        'encoder',
    
    ];

    public function expertisePersonalData(): BelongsTo
    {
        return $this->belongsTo(ProfileLibTblExpertiseSpec::class, 'specialization_code');
    }
}
