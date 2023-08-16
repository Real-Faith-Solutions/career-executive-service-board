<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompetencyTrainingProvider extends Model
{
    use HasFactory;

    protected $primarykey = 'providerID';

    protected $table = 'training_tblProvider';
    
    protected $fillable = [

        'provider',
        'house_bldg',
        'st_road',
        'brgy_vill',
        'city_code',
        'contactno',
        'emailadd',
        'contactperson',
        'encoder',
        'updated_by',

    ];
}
