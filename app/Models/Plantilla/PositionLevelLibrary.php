<?php

namespace App\Models\Plantilla;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class PositionLevelLibrary extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'plantillalib_tblPositionLevel';
    protected $primaryKey = 'poslevel_code';

    public function positionMaster(): BelongsTo
    {
        return $this->belongsTo(PositionMasterLibrary::class, 'poslevel_code');
    }
}
