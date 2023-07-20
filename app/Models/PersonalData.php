<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class PersonalData extends Model
{
    use HasFactory;

    protected $table = 'profile_tblMain';

    protected $primaryKey = 'cesno';

    protected $fillable = [

        'picture',
        'email',
        'status',
        'title',
        'lastname',
        'firstname',
        'name_extension',
        'middlename',
        'middleinitial',
        'nickname',
        'birth_date',
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
        'CESStat_code',
        'encoder',
        'acno',
        'remarks',

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
    
    public function profileAddress(): HasMany
    {
        return $this->hasMany(ProfileAddress::class);
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

    public function caseRecords(): HasMany
    {
        return $this->hasMany(CaseRecords::class);
    }

    public function healthRecords(): HasMany
    {
        return $this->hasMany(HealthRecords::class);
    }

    public function expertise(): HasMany
    {
        return $this->hasMany(ProfileTblExpertise::class);
    }

    public function languages(): HasMany
    {
        return $this->hasMany(ProfileTblLanguages::class);
    }

    public function otherTraining(): HasMany
    {
        return $this->hasMany(ProfileTblTrainingMngt::class);
    }

    public function cesStatusCode(): BelongsToMany
    {
        return $this->belongsToMany(ProfileLibTblCesStatus::class, 'profile_tblCESstatus',  'cesno', 'cesstat_code')
        ->as('profile_tblCESstatus')
        ->withPivot('cesno','ctrlno','cesstat_code','acc_code','type_code','official_code','resolution_no','appointed_dt')
        ->withTimestamps();
    }

    public function cesStatusAccCode(): BelongsToMany
    {
        return $this->belongsToMany(ProfileLibTblCesStatusAcc::class, 'profile_tblCESstatus',  'cesno', 'acc_code')
        ->as('profile_tblCESstatus')
        ->withPivot('cesno','ctrlno','cesstat_code','acc_code','type_code','official_code','resolution_no','appointed_dt')
        ->withTimestamps();
    }

    public function cesStatusTypeCode(): BelongsToMany
    {
        return $this->belongsToMany(ProfileLibTblCesStatusType::class, 'profile_tblCESstatus',  'cesno', 'type_code')
        ->as('profile_tblCESstatus')
        ->withPivot('cesno','ctrlno','cesstat_code','acc_code','type_code','official_code','resolution_no','appointed_dt')
        ->withTimestamps();
    }

    public function appointingAuthority(): BelongsToMany
    {
        return $this->belongsToMany(ProfileLibTblAppAuthority::class, 'profile_tblCESstatus',  'cesno', 'official_code')
        ->as('profile_tblCESstatus')
        ->withPivot('cesno','ctrlno','cesstat_code','acc_code','type_code','official_code','resolution_no','appointed_dt')
        ->withTimestamps();
    }
  
}