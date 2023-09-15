<?php

namespace App\Models\Plantilla;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class ApptStatus extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'plantillalib_tblApptStatus';
    protected $primaryKey = 'appt_stat_code';

    public function apptStatus(): HasMany
    {
        return $this->hasMany(PlanAppointee::class, 'appt_stat_code', 'appt_stat_code');
    }
}
