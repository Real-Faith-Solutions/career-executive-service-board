<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class PersonalData extends Model
{
    use HasFactory;

    protected $table = 'personal_data';

    protected $primaryKey = 'cesno';

    protected $fillable = [

        'avatar',
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
        'tin'

    ];

    public function spouses(): HasMany
    {
        return $this->hasMany(SpouseRecords::class);
    }

    public function father(): HasOne
    {
        return $this->hasOne(Father::class);
    }

    public function mother(): HasOne
    {
        return $this->hasOne(Mother::class);
    }

    public function childrens(): HasMany
    {
        return $this->hasMany(ChildrenRecords::class);
    }

    public function educations(): HasMany
    {
        return $this->hasMany(EducationalAttainment::class);
    }

    public function identifications(): HasMany
    {
        return $this->hasMany(Identification::class);
    }

    public function examinationTakens(): HasMany
    {
        return $this->hasMany(ExaminationsTaken::class);
    }

    public function scholarships(): HasMany
    {
        return $this->hasMany(Scholarships::class);
    }

    public function researchAndStudies(): HasMany
    {
        return $this->hasMany(ResearchAndStudies::class);
    }

    public function workExperience(): HasMany
    {
        return $this->hasMany(ProfileTblWorkExperience::class);
    }

    public function awardsAndCitations(): HasMany
    {
        return $this->hasMany(AwardAndCitations::class);
    }

    public function affiliations(): HasMany
    {
        return $this->hasMany(Affiliations::class);
    }
    
}
