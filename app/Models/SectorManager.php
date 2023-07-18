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
    protected $primaryKey = 'sector_id';
    protected $fillable = [
        'title',
        'description',
        'encoder',
    ];


}
