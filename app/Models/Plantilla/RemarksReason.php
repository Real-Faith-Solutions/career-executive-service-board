<?php

namespace App\Models\Plantilla;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RemarksReason extends Model
{
    use HasFactory;
    protected $table = 'plantilla_tblRemarksReason';

    protected $fillable = [
        'cesno',
        'subject',
        'notes',
        'effect_dt',
        'created',
        'encoder',
        'source',
    ];
    
}
