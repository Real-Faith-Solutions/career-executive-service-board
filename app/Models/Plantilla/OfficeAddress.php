<?php

namespace App\Models\Plantilla;

use App\Models\ProfileLibCities;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class OfficeAddress extends Model
{
    use HasFactory, SoftDeletes;
    const CREATED_AT = 'encdate';
    const UPDATED_AT = 'lastupd_dt';
    protected $table = 'plantilla_tblOffice_Addr';
    protected $primaryKey = 'officeid';
    protected $fillable = [
        'officeid',
        'floor_bldg',
        'house_no_st',
        'brgy_dist',
        'city_code',
        'contactno',
        'emailadd',
        'isActive',
        'ofcaddrid',
        'updated_by',
        'encoder',
    ];

    public function Office(): BelongsTo
    {
        return $this->belongsTo(Office::class, 'officeid', 'officeid');
    }

    public function cities()
    {
        return $this->belongsTo(ProfileLibCities::class, 'city_code', 'city_code');
    }
}
