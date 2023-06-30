<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProfileLibTblCaseStatus extends Model
{
    use HasFactory;

    protected $table = "profilelib_tblCaseStatus";

    protected $fillable = [
        'STATUS_CODE',
        'TITLE',
    ]; 
}
