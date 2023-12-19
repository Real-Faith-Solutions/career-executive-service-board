<?php

namespace App\Models\Plantilla;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ReasonCode extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'plantillalib_tblReasonCode';
    protected $primaryKey = 'reason_code';
    protected $fillable = [
        'module',
        'title',
    ];
}
