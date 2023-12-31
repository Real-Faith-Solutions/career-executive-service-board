<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProfileLibTblEducDegree extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = "profilelib_tblEducDegree";

    protected $primaryKey = 'CODE';

    protected $fillable = [
        'CODE',
        'DEGREE',
    ];

    public function educationDegreeLibrary()
    {
        $profileLibTblEducDegree = ProfileLibTblEducDegree::orderBy('DEGREE')->get();

        return $profileLibTblEducDegree;
    }
}
