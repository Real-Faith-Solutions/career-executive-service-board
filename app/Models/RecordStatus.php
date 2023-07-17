<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RecordStatus extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $primaryKey = 'ctrlno';
    protected $table = 'record_statuses';
    protected $fillable = ['name'];
}
