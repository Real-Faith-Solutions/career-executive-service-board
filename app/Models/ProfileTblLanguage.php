<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProfileTblLanguage extends Model
{
    use HasFactory,SoftDeletes;

    const CREATED_AT = 'encdate';
    const UPDATED_AT = 'lastupd_dt';

    protected $table = 'profile_tblLanguages';

    protected $primaryKey = 'ctrlno';

    protected $fillable = [

        'cesno',
        'lang_code',
        'encoder',
        'lastupd_enc',

    ];

    public function languagePersonalData(): BelongsTo
    {
        return $this->belongsTo(ProfileLibTblLanguageRef::class, 'lang_code');
    }    
}