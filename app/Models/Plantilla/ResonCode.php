<?php

namespace App\Models\Plantilla;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResonCode extends Model
{
    use HasFactory;
    protected $table = 'plantillalib_tblReasonCode';
    protected $primaryKey = 'reason_code';
    protected $fillable = [
        'module',
        'title',
    ];
}
