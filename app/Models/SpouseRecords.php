<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class SpouseRecords extends Model
{
    use HasFactory;
    protected $guarded = [];

    protected static function boot()
    {
        parent::boot();

        SpouseRecords::creating(function($model) {
            $model->age_sn_fp = Carbon::parse($model->birthdate_sn_fp)->age;
        });
    }
}
