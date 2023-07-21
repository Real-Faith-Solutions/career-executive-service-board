<?php

namespace App\Models\Plantilla;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MotherDepartment extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'vw_plantilla_motherdept';
}
