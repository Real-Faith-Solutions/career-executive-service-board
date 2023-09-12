<?php

namespace App\Models\Plantilla;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class DepartmentAgencyType extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'plantillalib_tblAgencyType';
    protected $primaryKey = 'agency_typeid';
    protected $fillable = [
        'sectorid',
        'title',
        'encoder',
    ];

    public function departmentAgency(): HasMany
    {
        return $this->hasMany(DepartmentAgency::class, 'plantillalib_tblAgencyType_id', 'agency_typeid');
    }
}
