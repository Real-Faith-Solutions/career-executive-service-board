<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProfileAddress extends Model
{
    protected $table = 'profile_tblAddress';
    protected $primaryKey = 'ctrlno';

    protected $fillable = [
        'personal_data_cesno',
        'type',
        'region_code',
        'region_name',
        'city_or_municipality_code',
        'city_or_municipality_name',
        'brgy_code',
        'brgy_name',
        'zip_code',
        'street_lot_bldg_floor',
        'encoder',
        'last_updated_by',
    ];

    public function profileAddressPersonalData(): BelongsTo
    {
        return $this->belongsTo(PersonalData::class);
    }

}
//
