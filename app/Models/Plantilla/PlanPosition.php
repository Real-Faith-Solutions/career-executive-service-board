<?php

namespace App\Models\Plantilla;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class PlanPosition extends Model
{
    use HasFactory, SoftDeletes;
    const CREATED_AT = 'created_dt';
    const UPDATED_AT = 'lastupd_dt';

    protected $table = 'plantilla_tblPlanPositions';
    protected $primaryKey = 'plantilla_id';
    protected $fillable = [
        'officeid',
        'pos_code',
        'pos_suffix',
        'pos_func_name',
        'pos_default',
        'corp_sg',
        'pos_sequence',
        'is_ces_pos',
        'is_vacant',
        'is_occupied',
        'remarks',
        'cbasis_code',
        'cbasis_remarks',
        'item_no',
        'pres_apptee',
        'is_active',
        'is_generic',
        'is_head',
        'created_user',
        'lastupd_user',
    ];



    public function positionMasterLibrary(): BelongsTo
    {
        return $this->belongsTo(PositionMasterLibrary::class, 'pos_code');
    }

    public function classBasis()
    {
        return $this->belongsTo(ClassBasis::class, 'cbasis_code', 'cbasis_code');
    }

    public function office(): BelongsTo
    {
        return $this->belongsTo(Office::class, 'officeid', 'officeid');
    }

    public function planAppointee()
    {
        return $this->hasMany(PlanAppointee::class, 'plantilla_id', 'plantilla_id');
    }
}
