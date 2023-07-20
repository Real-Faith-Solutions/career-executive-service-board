<?php

namespace App\Models\Plantilla;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class DepartmentAgencyType extends Model
{
    use HasFactory;

    protected $table = 'plantillalib_tblAgencyType';
    protected $primaryKey = 'agency_typeid';
    protected $fillable = [
        'title',
        'description',
        'encoder',
    ];

    public function departmentAgency(): HasMany
    {
        return $this->hasMany(DepartmentAgency::class, 'plantillalib_tblAgencyType_id', 'agency_typeid');
    }
}
