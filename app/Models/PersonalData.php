<?php

namespace App\Models;

use App\Models\Lenard\Test;
use App\Models\Plantilla\OtherAssignment;
use App\Models\Plantilla\PlanAppointee;
use App\Models\Plantilla\PlanPosition;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
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
        return $this->hasMany(ChildrenRecords::class, 'cesno', 'cesno');
    }

    public function educations(): HasMany
    {
        return $this->hasMany(EducationalAttainment::class, 'cesno', 'cesno');
    }

    public function identifications(): HasOne
    {
        return $this->hasOne(Identification::class);
    }

    public function examinationTakens(): HasMany
    {
        return $this->hasMany(ExaminationsTaken::class, 'cesno', 'cesno');
    }

    public function profileAddress(): HasMany
    {
        return $this->hasMany(ProfileAddress::class);
    }

    public function scholarships(): HasMany
    {
        return $this->hasMany(Scholarships::class, 'cesno', 'cesno');
    }

    public function researchAndStudies(): HasMany
    {
        return $this->hasMany(ResearchAndStudies::class, 'cesno', 'cesno');
    }

    public function workExperience(): HasMany
    {
        return $this->hasMany(ProfileTblWorkExperience::class, 'cesno', 'cesno');
    }

    public function awardsAndCitations(): HasMany
    {
        return $this->hasMany(AwardAndCitations::class, 'cesno', 'cesno');
    }

    public function affiliations(): HasMany
    {
        return $this->hasMany(Affiliations::class, 'cesno', 'cesno');
    }

    public function caseRecords(): HasMany
    {
        return $this->hasMany(CaseRecords::class, 'cesno', 'cesno');
    }

    public function healthRecords(): HasOne
    {
        return $this->hasOne(HealthRecords::class, 'cesno', 'cesno');
    }

    public function expertise(): HasMany
    {
        return $this->hasMany(ProfileTblExpertise::class, 'cesno', 'cesno');
    }

    public function languages(): HasMany
    {
        return $this->hasMany(ProfileTblLanguage::class, 'cesno', 'cesno');
    }

    public function otherTraining(): HasMany
    {
        return $this->hasMany(ProfileTblTrainingMngt::class, 'cesno', 'cesno');
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

    public function competencyNonCesAccreditedTraining(): HasMany
    {
        return $this->hasMany(CompetencyNonCesAccreditedTraining::class, 'cesno', 'cesno');
    }

    public function users(): HasOne
    {
        return $this->hasOne(User::class);
    }

    public function approvedFile(): HasMany
    {
        return $this->hasMany(ApprovedFile::class);
    }

    public function competencyCesTraining(): HasMany
    {
        return $this->hasMany(TrainingParticipants::class, 'cesno', 'cesno');
    }

    // plantilla
    public function planAppointee(): BelongsTo
    {
        return $this->belongsTo(PlanAppointee::class, 'cesno', 'cesno');
    }

    public function cesStatus(): BelongsTo
    {
        return $this->belongsTo(ProfileLibTblCesStatus::class, 'CESStat_code', 'code');
    }

    public function otherAssignment(): HasMany
    {
        return $this->hasMany(OtherAssignment::class, 'cesno');
    }
}
