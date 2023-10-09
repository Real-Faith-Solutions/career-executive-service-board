<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class ChildrenRecords extends Model
{
    use HasFactory, SoftDeletes;

    const CREATED_AT = 'encdate';
    const UPDATED_AT = 'lastupd_dt';

    protected $primaryKey = 'ctrlno';

    protected $table= 'profile_tblChildren';

    protected $fillable = [

        'cesno',
        'lname',
        'fname',
        'mname',
        'name_extension',
        'gender',
        'bdate',
        'birth_place',
        'encoder',
        'lastup_enc',

    ];

    public function personalData(): BelongsTo
    {
        return $this->belongsTo(PersonalData::class);
    }

}
