<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PersonalData extends Model
{
    use HasFactory;

    protected $table = "personal_data";

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

}