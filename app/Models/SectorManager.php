<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SectorManager extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'plantilla_tbl_sectors';
    protected $primaryKey = 'sectorid';
    protected $fillable = [
        'title',
        'description',
        'encoder',
    ];


}
