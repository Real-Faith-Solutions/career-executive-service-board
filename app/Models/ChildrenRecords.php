<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChildrenRecords extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $table= 'profile_tblChildren';
}