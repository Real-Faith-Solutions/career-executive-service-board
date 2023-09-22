<?php

namespace App\Models\Eris;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LibraryRankTracker extends Model
{
    use HasFactory;

    protected $primaryKey = 'ctrlno';

    protected $table = "erad_libRankTracker";

    protected $fillable = [

        'catid',
        'description',

    ];
}
