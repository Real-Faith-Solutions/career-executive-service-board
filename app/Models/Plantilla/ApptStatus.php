<?php

namespace App\Models\Plantilla;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\SoftDeletes;

class ApptStatus extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'plantillalib_tblApptStatus';
    protected $primaryKey = 'appt_stat_code';
    protected $fillable = [
        'title',
        'encoder',
        'updated_by',
    ];

    public function apptStatus(): HasManyThrough
    {
        return $this->hasManyThrough(
            PlanAppointee::class,
            'appt_stat_code',
            'appt_stat_code',
            OtherAssignment::class,
            'appt_stat_code',
        );
    }
}
