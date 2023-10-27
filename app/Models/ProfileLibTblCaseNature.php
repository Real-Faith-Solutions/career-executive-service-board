<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProfileLibTblCaseNature extends Model
{
    use HasFactory, SoftDeletes;

    protected $primaryKey = 'STATUS_CODE';

    protected $table = "profilelib_tblCaseNature";

    protected $fillable = [
        'STATUS_CODE',
        'TITLE',
    ]; 

    public function caseNature()
    {
        $profileLibTblCaseNature = ProfileLibTblCaseNature::orderBy('TITLE', 'asc')->get();

        return $profileLibTblCaseNature;
    }
}
