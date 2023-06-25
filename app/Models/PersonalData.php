<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class PersonalData extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $appends = ['age_now'];

    public function cesstatusvalue(){
        return $this->hasOne(profilelib_tblcesstatus::class, 'code', 'cesstat_code');
    }

    public function getAgeNowAttribute(){
        return Carbon::parse($this->birthdate)->age;
    }

    protected static function boot()
    {
        parent::boot();

        PersonalData::creating(function($model) {
            $model->age = Carbon::parse($model->birthdate)->age;
        });
    }
}
