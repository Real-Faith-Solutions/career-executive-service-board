<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProfileTblLanguages extends Model
{

    use HasFactory;
 
    use SoftDeletes;

    protected $table = 'profile_tblLanguages';

    protected $primaryKey = 'ctrlno';

    protected $fillable = [

        'personal_data_cesno',
        'language_description',
        'encoder',

    ];
    
}