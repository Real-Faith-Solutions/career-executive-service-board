<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PersonalData extends Model
{
    use HasFactory;
<<<<<<< HEAD
    
    protected $table = "personal_data";

=======

    protected $table = "personal_data";
    protected $primaryKey = 'cesno';
>>>>>>> 891364a068cb23cd58e48a5be90d9ad9e2a47147
    protected $fillable = [
        'status',
        'title',
        'lastname',
        'firstname',
        'name_extension',
        'middlename',
        'mi',
        'nickname',
        'birthdate',
        'age',
        'birth_place',
        'gender',
        'gender_by_choice',
        'civil_status',
        'religion',
        'height',
        'weight',
        'member_of_indigenous_group',
        'single_parent',
        'citizenship',
        'dual_citizenship',
        'person_with_disability',
        'gsis',
        'pagibig',
        'philhealth',
        'sss_no',
        'tin',
    ];
<<<<<<< HEAD
    
}
=======

}
>>>>>>> 891364a068cb23cd58e48a5be90d9ad9e2a47147
