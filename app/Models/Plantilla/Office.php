<?php

namespace App\Models\Plantilla;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Office extends Model
{
    use HasFactory, SoftDeletes;
    const CREATED_AT = 'encdate';
    const UPDATED_AT = 'lastupd_dt';
    protected $table = 'plantilla_tblOffice';
    protected $primaryKey = 'officeid';
    protected $fillable = [
        'officelocid',
        'title',
        'acronym',
        'website',
        'is_active',
        'encoder',
        'lastupd_enc',
    ];

    public function officeAddress(): HasOne
    {
        return $this->hasOne(OfficeAddress::class, 'officeid');
    }

    public function agencyLocation(): BelongsTo
    {
        return $this->belongsTo(AgencyLocation::class, 'officelocid', 'officelocid');
    }
}
