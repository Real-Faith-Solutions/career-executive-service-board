<?php

namespace App\Models\Plantilla;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class OfficeAddress extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'plantilla_tblOffice_Addr';
    protected $primaryKey = 'officeid';
    protected $fillable = [
        'officeid',
        'floor_bldg',
        'house_no_st',
        'brgy_dist',
        'city_code',
        'contact',
        'email',
        'isActive',
        'ofcaddrid',
        'updated_by',
        'encoder',
    ];

    public function Office(): BelongsTo
    {
        return $this->belongsTo(Office::class, 'officeid', 'officeid');
    }
}
