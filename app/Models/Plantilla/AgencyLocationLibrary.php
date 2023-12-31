<?php

namespace App\Models\Plantilla;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class AgencyLocationLibrary extends Model
{
    const CREATED_AT = 'encdate';
    const UPDATED_AT = 'lastupd_dt';
    use HasFactory, SoftDeletes;
    protected $table = 'plantillalib_tblAgencyLocation';
    protected $primaryKey = 'agencyloc_Id';
    protected $fillable = [
        'title',
        'encoder',
        'updated_by',
    ];

    public function agencyLocation(): HasMany
    {
        return $this->hasMany(AgencyLocation::class, 'officelocid');
    }
}
