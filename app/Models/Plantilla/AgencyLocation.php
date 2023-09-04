<?php

namespace App\Models\Plantilla;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class AgencyLocation extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'plantilla_tblAgencyLocation';
    protected $primaryKey = 'officelocid';
    protected $fillable = [
        'deptid',
        'title',
        'acronym',
        'agencyloc_Id',
        'telno',
        'email',
        'region',
        'encoder',
    ];

    public function agencyLocationLibrary(): BelongsTo
    {
        return $this->belongsTo(AgencyLocationLibrary::class, 'agencyloc_Id', 'agencyloc_Id');
    }
}