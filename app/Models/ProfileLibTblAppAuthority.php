<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProfileLibTblAppAuthority extends Model
{
    use HasFactory;

    protected $table = "profilelib_tblappAuthority";

    protected $fillable = [
        'code',
        'description',
    ]; 
}
