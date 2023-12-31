<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Title extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $primaryKey = 'ctrlno';
    protected $table = 'titles';
    protected $fillable = ['name'];

}
