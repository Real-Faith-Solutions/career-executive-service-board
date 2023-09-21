<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeviceVerification extends Model
{
    protected $table = 'device_verification'; // Specify the table name

    protected $fillable = [
        'personal_data_cesno',
        'confirmation_code', 
        'device_id', 
        'verified', 
    ];

}
