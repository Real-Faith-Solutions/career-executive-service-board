<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProfileLibTblLanguageRef extends Model
{

    use HasFactory;

    use SoftDeletes;

    protected $table = "profilelib_tblLanguageRef";

    protected $primaryKey = 'code';

    protected $fillable = [

        'code',
        'title',

    ];

    // public function languagePersonalData(): BelongsToMany
    // {
    //     return $this->belongsToMany(PersonalData::class, 'profile_tblLanguages', 'language_code', 'personal_data_cesno')
    //     ->as('profile_tblLanguages')
    //     ->withPivot('ctrlno', 'encoder')
    //     ->withTimestamps();
    // }
     
}
