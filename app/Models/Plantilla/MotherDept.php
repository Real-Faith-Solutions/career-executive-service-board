<?php

namespace App\Models\Plantilla;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MotherDept extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'plantilla_motherdept';
    protected $primaryKey = 'deptid';
    protected $fillable = [
        'title',
        'encoder',
        'updated_by',
    ];

    public function deptAgency()
    {
        return $this->hasMany(DepartmentAgency::class, 'deptid');
    }
}
