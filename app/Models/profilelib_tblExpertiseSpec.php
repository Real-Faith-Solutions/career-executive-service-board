<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class profilelib_tblExpertiseSpec extends Model
{
    use HasFactory;
    protected $fillable = [
        'SpeExp_Code',
        'Title',
    ]; 
}
