<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProfileLibTblCesStatusType extends Model
{
    use HasFactory;

    protected $table = "profilelib_tblcesstatustype";

    protected $fillable = [
        'code',
        'description',
    ]; 
}
