<?php

namespace App\Models\Plantilla;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class PlanPosition extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'plantilla_tblPlanPositions';
    protected $primaryKey = 'plantilla_id';

    public function positionMasterLibrary(): BelongsTo
    {
        return $this->belongsTo(PositionMasterLibrary::class, 'pos_code');
    }
}
