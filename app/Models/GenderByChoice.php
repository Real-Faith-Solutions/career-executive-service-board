<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class GenderByChoice extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $primaryKey = 'ctrlno';
    protected $table = 'gender_by_choices';
    protected $fillable = ['name'];

}
