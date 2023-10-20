<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProfileLibTblCaseNature extends Model
{
    use HasFactory;

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
