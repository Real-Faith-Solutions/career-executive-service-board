<?php

namespace App\Models\Plantilla;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DepartmentAgency extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'plantilla_tblDeptAgency';
    protected $primaryKey = 'deptid';
}
