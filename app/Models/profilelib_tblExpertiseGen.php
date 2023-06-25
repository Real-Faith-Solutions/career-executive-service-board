<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class profilelib_tblExpertiseGen extends Model
{
    use HasFactory;
    protected $fillable = [
        'GenExp_Code',
        'Title',
    ]; 
}
