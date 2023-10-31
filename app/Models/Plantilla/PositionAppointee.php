<?php

namespace App\Models\Plantilla;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PositionAppointee extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'position_appointees';
    protected $fillable = [
        'appointee_id',
        'name',
    ];

    public function planAppointee()
    {
        return $this->belongsTo(PlanAppointee::class, 'appointee_id', 'appointee_id');
    }
}
