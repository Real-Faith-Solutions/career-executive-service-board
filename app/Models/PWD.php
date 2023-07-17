<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PWD extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $primaryKey = 'ctrlno';
    protected $table = 'p_w_d_s';
    protected $fillable = ['name'];
}
