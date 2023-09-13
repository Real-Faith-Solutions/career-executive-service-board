<?php

namespace App\Models\Plantilla;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class PositionMasterLibrary extends Model
{
    use HasFactory;
    protected $table = 'plantillalib_tblPositionMaster';
    protected $primaryKey = 'pos_code';

    public function planPosition(): HasMany
    {
        return $this->hasMany(PlanPosition::class, 'pos_code');
    }

    public function positionLevel(): HasOne
    {
        return $this->hasOne(PositionLevelLibrary::class, 'poslevel_code');
    }
}
