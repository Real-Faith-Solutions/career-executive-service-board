<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class profilelib_tblcesstatus extends Model
{
    use HasFactory;
    protected $fillable = [
        'code',
        'description',
    ]; 
}
