<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProfileLibTblCesStatusAcc extends Model
{
    use HasFactory;

    protected $table = "profilelib_tblcesstatusAcc";

    protected $fillable = [
        'code',
        'description',
    ]; 
}
