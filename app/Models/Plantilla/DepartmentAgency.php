<?php

namespace App\Models\Plantilla;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class DepartmentAgency extends Model
{
    use HasFactory, SoftDeletes;
    const CREATED_AT = 'encdate';
    const UPDATED_AT = 'lastupd_dt';

    protected $table = 'plantilla_tblDeptAgency';
    protected $primaryKey = 'deptid';
    protected $fillable = [
        'sectorid',
        'agency_typeid',
        'title',
        'acronym',
        'website',
        'remarks',
        'submitted_by',
        'encoder',
    ];

    public function sectorManager(): BelongsTo
    {
        return $this->belongsTo(SectorManager::class, 'sectorid', 'sectorid');
    }

    public function departmentAgencyType(): BelongsTo
    {
        return $this->belongsTo(DepartmentAgencyType::class, 'agency_typeid', 'agency_typeid');
    }

    public function agencyLocation(): HasMany
    {
        return $this->hasMany(AgencyLocation::class, 'deptid');
    }
}
