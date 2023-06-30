<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProfileLibTblCesStatus extends Model
{
    use HasFactory;

    protected $table = "profilelib_tblcesstatus";

    protected $fillable = [
        'code',
        'description',
    ]; 
}
