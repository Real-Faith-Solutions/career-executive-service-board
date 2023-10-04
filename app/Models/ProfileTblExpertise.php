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

    const CREATED_AT = 'encdate';
    const UPDATED_AT = 'lastupd_dt';

    protected $primaryKey = 'ctrlno';

    protected $table = "profile_tblExpertise";

    protected $fillable = [

        'cesno',
        'SpeExp_Code',
        'encoder',
        'lastupd_enc',
    
    ];

    public function expertisePersonalData(): BelongsTo
    {
        return $this->belongsTo(ProfileLibTblExpertiseSpec::class, 'SpeExp_Code');
    }
}
