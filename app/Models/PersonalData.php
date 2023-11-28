<?php

namespace App\Models;

use App\Models\Plantilla\OtherAssignment;
use App\Models\Plantilla\PlanAppointee;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use PhpParser\Node\Stmt\Static_;

class PersonalData extends Model
{
    use HasFactory, SoftDeletes;

    const CREATED_AT = 'e_date';
    const UPDATED_AT = 'lastupd_dt';

    protected $table = 'profile_tblMain';

    protected $primaryKey = 'cesno';

    protected $fillable = [

        'cesno',
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
        'e_date',
        'lastupd_dt',

    ];

    // Accessor to get the 'email' attribute
    public function getEmailAttribute()
    {
        return $this->attributes['emailadd'];
    }

    // Mutator to set the 'email' attribute
    public function setEmailAttribute($value)
    {
        $this->attributes['emailadd'] = $value;
    }

    // Accessor to get the 'birth_date' attribute
    public function getBirthDateAttribute()
    {
        return $this->attributes['birthdate'];
    }

    // Mutator to set the 'birth_date' attribute
    public function setBirthDateAttribute($value)
    {
        $this->attributes['birthdate'] = $value;
    }

    // Accessor to get the 'birth_place' attribute
    public function getBirthPlaceAttribute()
    {
        return $this->attributes['birthplace'];
    }

    // Mutator to set the 'birth_place' attribute
    public function setBirthPlaceAttribute($value)
    {
        $this->attributes['birthplace'] = $value;
    }

    // Accessor to get the 'civil_status' attribute
    public function getCivilStatusAttribute()
    {
        return $this->attributes['civilstatus'];
    }

    // Mutator to set the 'civil_status' attribute
    public function setCivilStatusAttribute($value)
    {
        $this->attributes['civilstatus'] = $value;
    }

    public function search($search)
    {
        $personalData = PersonalData::query()
            ->where('cesno', "LIKE", "%$search%")
            ->orWhere('lastname',  "LIKE", "%$search%")
            ->orWhere('firstname',  "LIKE", "%$search%")
            ->orWhere('middlename',  "LIKE", "%$search%")
            ->orWhere('name_extension',  "LIKE", "%$search%")
            ->paginate(25);

        return $personalData;
    }

    public function latestCesStatus($cesno)
    {
        $latestCestatusCode = PersonalData::find($cesno);
        
        if($latestCestatusCode->cesStatus != null)
        {
            $latestCestatusDescription = $latestCestatusCode->cesStatus->description;
        }
        else
        {
            $latestCestatusDescription = null;
        }
        
        return $latestCestatusDescription;
    }

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

    public function latestProfileTblCesStatus(): HasOne
    {
        return $this->hasOne(ProfileTblCesStatus::class, 'cesno', 'cesno')->latestOfMany('appointed_dt');
    }

    public function getAppointingAuthorityDescription($personalData)
    {
        $currentStatus = ProfileTblCesStatus::where('cesno', $personalData->cesno)
                        ->where('cesstat_code', $personalData->CESStat_code)
                        ->value('official_code');

        $authority = ProfileLibTblAppAuthority::where('code', $currentStatus)->value('description');

        return $authority;
    }

    public function medicalHistoryRecords(): HasMany
    {
        return $this->hasMany(MedicalHistory::class);
    }

    public function pdfFile(): HasMany
    {
        return $this->hasMany(PdfLinks::class, 'cesno', 'cesno');
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

    public function cities(): BelongsTo
    {
        return $this->belongsTo(ProfileLibCities::class, 'birth_place', 'city_code');
    }

    public function religions(): BelongsTo
    {
        return $this->belongsTo(Religion::class, 'religion', 'ctrlno');
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
