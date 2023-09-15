<?php

namespace App\Models\Plantilla;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ClassBasis extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'plantillalib_tblClassBasis';
    protected $primaryKey = 'cbasis_code';
}
