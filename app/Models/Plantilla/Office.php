<?php

namespace App\Models\Plantilla;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Office extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'plantilla_tblOffice';
    protected $primaryKey = 'officeid';
    protected $fillable = [
        'officelocid',
        'title',
        'acronym',
        'website',
        'isActive',
        'encoder',
        'updated_by',
    ];
}