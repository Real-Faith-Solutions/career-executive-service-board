<?php

namespace App\Models\Plantilla;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class PositionMasterLibrary extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'plantillalib_tblPositionMaster';
    protected $primaryKey = 'pos_code';
    protected $fillable = [
        'dbm_title',
        'poslevel_code',
        'sg',
        'func_title',
        'encoder',
        'updated_by',
    ];

    public function planPosition(): HasMany
    {
        return $this->hasMany(PlanPosition::class, 'pos_code', 'pos_code');
    }

    public function positionLevel(): HasOne
    {
        return $this->hasOne(PositionLevelLibrary::class, 'poslevel_code', 'poslevel_code');
    }
}
