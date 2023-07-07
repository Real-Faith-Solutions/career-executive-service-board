<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ChildrenRecords extends Model
{
    use HasFactory;

    protected $primaryKey = 'ctrlno';

    protected $table= 'profile_tblChildren';

    protected $fillable = [

        'personal_data_cedsno',
        'last_name',
        'first_name',
        'middle_name',
        'name_extension',
        'birthdate',
        'birth_place',
        'encoder',

    ];
 
    public function personalData(): BelongsTo
    {
        return $this->belongsTo(PersonalData::class);
    }

}