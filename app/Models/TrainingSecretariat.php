<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TrainingSecretariat extends Model
{
    use HasFactory, SoftDeletes;

    const CREATED_AT = 'encdate';
    const UPDATED_AT = 'update_time';

    protected $primaryKey = 'ctrlno';

    protected $table = "training_secretariat";

    protected $fillable = [

        'description',
        'encoder',

    ];
}
