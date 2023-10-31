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
    const CREATED_AT = 'created_dt';
    const UPDATED_AT = 'lastupd_dt';
    protected $table = 'plantilla_tblPlanAppointees';
    protected $primaryKey = 'appointee_id';
    protected $fillable = [
        'plantilla_id',
        'cesno',
        'appt_stat_code',
        'appt_date',
        'assum_date',
        'is_appointee',
        'ofc_stat_code',
        'basis',
        'created_user',
        'lastupd_user',
    ];

    public function personalData(): HasOne
    {
        return $this->hasOne(PersonalData::class, 'cesno', 'cesno');
    }

    public function apptStatus(): BelongsTo
    {
        return $this->belongsTo(ApptStatus::class, 'appt_stat_code', 'appt_stat_code');
    }

    public function planPosition(): BelongsTo
    {
        return $this->belongsTo(PlanPosition::class, 'plantilla_id', 'plantilla_id');
    }
    public function positionAppointee()
    {
        return $this->hasOne(PositionAppointee::class, 'appointee_id');
    }
}
