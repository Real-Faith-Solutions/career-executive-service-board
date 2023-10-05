<?php

namespace App\Models\Plantilla;

use App\Models\PersonalData;
use App\Models\ProfileLibCities;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OtherAssignment extends Model
{
    use HasFactory, SoftDeletes;
    const CREATED_AT = 'encdate';
    const UPDATED_AT = 'lastupd_dt';

    protected $table = 'plantilla_tblOtherAssignment';
    protected $primaryKey = 'detailed_code';
    protected $fillable = [
        'cesno',
        'appt_status_code',
        'position',
        'office',
        'from_dt',
        'to_dt',
        'remarks',
        'house_bldg',
        'st_road',
        'brgy_vill',
        'city_code',
        'contactno',
        'email_addr',
        'encoder',
        'lastupd_enc',
    ];

    public function cities()
    {
        return $this->belongsTo(ProfileLibCities::class, 'city_code', 'city_code');
    }

    public function apptStatus()
    {
        return $this->belongsTo(ApptStatus::class, 'appt_status_code', 'appt_stat_code');
    }
    public function personalData()
    {
        return $this->belongsTo(PersonalData::class, 'cesno', 'cesno');
    }
}
