<?php

namespace App\Models\Plantilla;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class DepartmentAgencyType extends Model
{
    const CREATED_AT = 'encdate';
    const UPDATED_AT = 'lastupd_dt';
    use HasFactory, SoftDeletes;

    protected $table = 'plantillalib_tblAgencyType';
    protected $primaryKey = 'agency_typeid';
    protected $fillable = [
        'sectorid',
        'title',
        'encoder',
        'updated_by',
    ];

    public function departmentAgency(): HasMany
    {
        return $this->hasMany(DepartmentAgency::class, 'agency_typeid', 'agency_typeid');
    }

    public function sector()
    {
        return $this->belongsTo(SectorManager::class, 'sectorid', 'sectorid');
    }
}
