<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProfileLibTblCesStatus extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = "profilelib_tblcesstatus";

    protected $primaryKey = 'code';

    protected $fillable = [

        'code',
        'description',

    ];

    public function cesStatusLibrary()
    {
        $profileLibTblCesStatus = ProfileLibTblCesStatus::all();

        return $profileLibTblCesStatus;
    }

    public function personalData(): HasMany
    {
        return $this->hasMany(PersonalData::class);
    }
}
