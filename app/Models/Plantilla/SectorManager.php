<?php

namespace App\Models\Plantilla;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class SectorManager extends Model
{
    use HasFactory, SoftDeletes;
    const CREATED_AT = 'encdate';
    const UPDATED_AT = 'lastupd_date';

    protected $table = 'plantilla_tblSector';
    protected $primaryKey = 'sectorid';
    protected $fillable = [
        'title',
        'description',
        'encoder',
    ];

    public function departmentAgency(): HasMany
    {
        return $this->hasMany(DepartmentAgency::class, 'sectorid', 'sectorid');
    }
}
