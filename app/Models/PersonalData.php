<?php

namespace App\Models;

use App\Models\Lenard\Test;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class PersonalData extends Model
{
    use HasFactory;

    use SoftDeletes;

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
        return $this->hasMany(EducationalAttainment::class, 'personal_data_cesno', 'cesno');
    }

    public function identifications(): HasOne
    {
        return $this->hasOne(Identification::class);
    }

    public function examinationTakens(): HasMany
    {
        return $this->hasMany(ExaminationsTaken::class, 'personal_data_cesno', 'cesno');
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

    public function healthRecords(): HasOne
    {
        return $this->hasOne(HealthRecords::class);
    }

    public function expertise(): BelongsToMany
    {
        return $this->belongsToMany(ProfileLibTblExpertiseSpec::class, 'profile_tblExpertise', 'personal_data_cesno', 'specialization_code')
        ->as('profile_tblExpertise')
        ->withPivot('ctrlno', 'encoder')
        ->withTimestamps();
    }

    public function languages(): BelongsToMany
    {
        return $this->belongsToMany(ProfileLibTblLanguageRef::class, 'profile_tblLanguages', 'personal_data_cesno', 'language_code')
        ->as('profile_tblLanguages')
        ->withPivot('ctrlno', 'encoder')
        ->withTimestamps();
    }

    public function otherTraining(): HasMany
    {
        return $this->hasMany(ProfileTblTrainingMngt::class);
    }

    public function profileTblCesStatus(): HasMany
    {
        return $this->hasMany(ProfileTblCesStatus::class, 'cesno', 'cesno');
    }
    
    public function medicalHistoryRecords(): HasMany
    {
        return $this->hasMany(MedicalHistory::class);
    }

    public function pdfFile(): HasMany
    {
        return $this->hasMany(PdfLinks::class);
    }
  
    public function contacts(): HasOne
    {
        return $this->hasOne(Contacts::class);
    }

    public function requestFile(): HasMany
    {
        return $this->hasMany(RequestFile::class);
    }

    public function declineFile(): HasMany
    {
        return $this->hasMany(DeclineFile::class);
    }

}