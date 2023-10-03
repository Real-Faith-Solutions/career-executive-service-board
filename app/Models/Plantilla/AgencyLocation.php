<?php

namespace App\Models\Plantilla;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class AgencyLocation extends Model
{
    use HasFactory, SoftDeletes;
    const CREATED_AT = 'encdate';
    const UPDATED_AT = 'lastupd_dt';
    protected $table = 'plantilla_tblAgencyLocation';
    protected $primaryKey = 'officelocid';
    protected $fillable = [
        'deptid',
        'title',
        'acronym',
        'loctype_id',
        'telno',
        'emailaddr',
        'region',
        'encoder',
        'lastupd_enc',
    ];

    public function agencyLocationLibrary(): BelongsTo
    {
        return $this->belongsTo(AgencyLocationLibrary::class, 'loctype_id', 'agencyloc_Id');
    }

    public function departmentAgency(): BelongsTo
    {
        return $this->belongsTo(DepartmentAgency::class, 'deptid', 'deptid');
    }

    public function office(): HasMany
    {
        return $this->hasMany(Office::class, 'officelocid');
    }
}
