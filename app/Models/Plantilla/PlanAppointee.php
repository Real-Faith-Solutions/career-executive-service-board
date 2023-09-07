<?php

namespace App\Models\Plantilla;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PlanAppointee extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'plantilla_tblPlanAppointees';
    protected $primaryKey = 'appointee_id';
}
