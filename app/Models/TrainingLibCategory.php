<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TrainingLibCategory extends Model
{
    use HasFactory, SoftDeletes;

    public $timestamps = true;

    protected $primaryKey = 'ctrlno';

    protected $table = "traininglib_tblcategory";

    protected $fillable = [

        'description',
        'encoder',
        'updated_by',

    ];
}
