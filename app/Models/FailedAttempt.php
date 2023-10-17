<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FailedAttempt extends Model
{
    use HasFactory;

    protected $table = 'failed_attempts'; // Specify the table name

    protected $fillable = [
        'email',
        'ip_address', 
        'attempts', 
        'suspension', 
    ];
    
}
