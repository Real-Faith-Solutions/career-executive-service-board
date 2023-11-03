<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProfileLibTblExpertiseMaster extends Model
{
    use HasFactory, SoftDeletes;

    protected $primaryKey = 'RECNUM';

    protected $table = 'profilelib_tblExpertiseMaster';

    protected $fillable = [
        'SpeExp_CODE',
        'GenExp_CODE',
    ];
}
