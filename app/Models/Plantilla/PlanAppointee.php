<?php

namespace App\Models\Plantilla;

use App\Models\PersonalData;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class PlanAppointee extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'plantilla_tblPlanAppointees';
    protected $primaryKey = 'appointee_id';

    public function personalData(): HasOne
    {
        return $this->hasOne(PersonalData::class, 'cesno', 'cesno');
    }

    public function apptStatus(): BelongsTo{
        return $this->belongsTo(ApptStatus::class, 'appt_stat_code', 'appt_stat_code');
    }
}