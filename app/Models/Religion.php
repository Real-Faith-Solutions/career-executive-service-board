<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Religion extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $primaryKey = 'ctrlno';
    protected $table = 'religions';
    protected $fillable = ['name'];


    public function personalData()
    {
        return $this->hasMany(PersonalData::class, 'ctrlno');
    }
}
