<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProfileLibTblCaseStatus extends Model
{
    use HasFactory, SoftDeletes;

    protected $primaryKey = 'STATUS_CODE';

    protected $table = "profilelib_tblCaseStatus";

    protected $fillable = [
        'STATUS_CODE',
        'TITLE',
    ]; 

    public function caseStatus()
    {
        $profileLibTblCaseStatus = ProfileLibTblCaseStatus::orderBy('TITLE', 'asc')->get();

        return $profileLibTblCaseStatus;
    }
}
