<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProfileLibTblExpertiseMaster extends Model
{
    use HasFactory;

    protected $primaryKey = 'RECNUM';

    protected $table = 'profilelib_tblExpertiseMaster';

    protected $fillable = [
        'SpeExp_CODE',
        'GenExp_CODE',
    ];
}
