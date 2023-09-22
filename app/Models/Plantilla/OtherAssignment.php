<?php

namespace App\Models\Plantilla;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OtherAssignment extends Model
{
    use HasFactory;
    const CREATED_AT = 'encdate';
    const UPDATED_AT = 'lastupd_dt';

    protected $table = 'plantilla_tblOtherAssignment';
    protected $primaryKey = 'detailed_code';
}
