<?php

namespace App\Http\Controllers;

use App\Models\CompetencyTrainingVenueManager;
use App\Models\PersonalData;
use App\Models\ProfileLibTblCesStatus;
use App\Models\ProfileLibTblExpertiseGen;
use App\Models\ResourceSpeaker;
use App\Models\TrainingLibCategory;
use App\Models\TrainingParticipants;
use App\Models\TrainingSecretariat;
use App\Models\TrainingSession;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class TrainingSessionController extends Controller
{
    // training session methods
        public function index()
        {
            $trainingSession = TrainingSession::paginate(25);

            return view('admin.competency.partials.training_session.table', compact('trainingSession'));
        }

        public function create()
        {
            $trainingLibCategory = TrainingLibCategory::all();
            $competencyTrainingVenueManager = CompetencyTrainingVenueManager::all();
            $trainingSecretariat = TrainingSecretariat::all();
            $profileLibTblExpertiseGen = ProfileLibTblExpertiseGen::all();
            $resourceSpeaker = ResourceSpeaker::all();

            return view('admin.competency.partials.training_session.form', compact('trainingLibCategory', 'competencyTrainingVenueManager', 'trainingSecretariat', 'profileLibTblExpertiseGen', 'resourceSpeaker'));
        }

        public function store(Request $request)
        {
            $request->validate([
                'title' => ['required', 'max:60', 'min:2', 'regex:/^[a-zA-Z ]*$/', 'unique:training_tblSessions,title'],
                'category' => ['required'],
                'specialization' => ['required'],
                'from_dt' => ['required'],
                'to_dt' => ['required'],
                'venue' => ['required'],
                'no_hours' => ['required', 'numeric', 'digits_between:1,4'],
                'barrio' => ['nullable', 'max:60', 'min:2'],
                'resource_speaker' => ['required'],
                'session_director' => ['required'],
                'status' => ['required'],
                'remarks' => ['required', 'regex:/^[a-zA-Z ]*$/'],
            ]);

            /** @var \App\Models\User $user */
            $user = Auth::user();
            $encoder = $user->userName();

            TrainingSession::create([
                'title' => $request->title,
                'category' => $request->category,  
                'specialization' => $request->specialization,  
                'from_dt' => $request->from_dt,  
                'to_dt' => $request->to_dt,  
                'venueId' => $request->venue,  
                'status' => $request->status,  
                'remarks' => $request->remarks,  
                'barrio' => $request->barrio,  
                'no_hours' => $request->no_hours,  
                'session_director' => $request->session_director,   
                'speakerid' => $request->resource_speaker,  
                'encoder' => $encoder,    
            ]);

            return to_route('training-session.index')->with('message', 'Save Sucessfully');
        }

        public function edit($ctrlno)
        {
            $trainingSession = TrainingSession::find($ctrlno);

            if(!$trainingSession)
            {
                return redirect()->back()->with('error', 'Something Went Wrong');
            }

            $trainingLibCategory = TrainingLibCategory::all();
            $competencyTrainingVenueManager = CompetencyTrainingVenueManager::all();
            $trainingSecretariat = TrainingSecretariat::all();
            $profileLibTblExpertiseGen = ProfileLibTblExpertiseGen::all();
            $resourceSpeaker = ResourceSpeaker::all();

            return view('admin.competency.partials.training_session.edit', compact('trainingSession', 'trainingLibCategory', 'competencyTrainingVenueManager', 'trainingSecretariat', 'profileLibTblExpertiseGen', 'resourceSpeaker'));
        }

        public function update(Request $request, $ctrlno)
        {
            $request->validate([
                'title' => ['required', 'max:60', 'min:2', 'regex:/^[a-zA-Z ]*$/', Rule::unique('training_tblSessions')->ignore($ctrlno, 'sessionid')],
                'category' => ['required'],
                'specialization' => ['required'],
                'from_dt' => ['required'],
                'to_dt' => ['required'],
                'venue' => ['required'],
                'no_hours' => ['required','numeric', 'digits_between:1,4'],
                'barrio' => ['nullable', 'max:60', 'min:2'],
                'resource_speaker' => ['required'],
                'session_director' => ['required'],
                'status' => ['required'],
                'remarks' => ['required', 'regex:/^[a-zA-Z ]*$/'],
            ]);
            

            $trainingSession = TrainingSession::find($ctrlno);
            $trainingSession->title = $request->title;
            $trainingSession->category = $request->category;
            $trainingSession->specialization = $request->specialization;
            $trainingSession->from_dt = $request->from_dt;
            $trainingSession->to_dt = $request->to_dt;
            $trainingSession->venueid = $request->venue;
            $trainingSession->status = $request->status;
            $trainingSession->remarks = $request->remarks;
            $trainingSession->barrio = $request->barrio;
            $trainingSession->no_hours = $request->no_hours;
            $trainingSession->session_director = $request->session_director;
            $trainingSession->speakerid = $request->resource_speaker;
            $trainingSession->save();

            return to_route('training-session.index')->with('message', 'Update Sucessfully');
        }

        public function destroy($ctrlno)
        {
            $trainingSession = TrainingSession::find($ctrlno);

            // count the participant that already register to training session
            $trainingParticipantList = $trainingSession->trainingParticipantList()->withTrashed()->count();

            $participantCount = 1;

            if($trainingParticipantList >= $participantCount)
            {
                return redirect()->back()->with('error', 'This Training Session has Already Participant, Can\'t Delete !!');
            }

            $trainingSession->delete();

            return back()->with('message', 'Deleted Sucessfully');
        }

        public function recentlyDeleted()
        {
            $trainingSessionTrashedRecord = TrainingSession::onlyTrashed()->paginate(25);

            return view('admin.competency.partials.training_session.trashbin', compact('trainingSessionTrashedRecord'));
        }


        public function restore($ctrlno)
        {
            $trainingSessionTrashedRecord = TrainingSession::onlyTrashed()->find($ctrlno);
            $trainingSessionTrashedRecord->restore();

            return back()->with('info', 'Data Restored Sucessfully');
        }
    
        public function forceDelete($ctrlno)
        {
            $trainingSessionTrashedRecord = TrainingSession::onlyTrashed()->find($ctrlno);
            $trainingSessionTrashedRecord->forceDelete();
    
            return back()->with('info', 'Data Permanently Deleted');
        }
    // end of  training session methods

    // training session participant methods
        public function participantList($sessionId)
        {
            $trainingSession = TrainingSession::find($sessionId);
            $trainingParticipantList = $trainingSession->trainingParticipantList;

            return view('admin.competency.partials.training_session.participant_list', compact('trainingParticipantList', 'trainingSession', 'sessionId'));
        }

        public function addParticipant(Request $request, $sessionId)
        {
            $search = $request->input('search');

            // search query for personal data
            $searchPersonalData = PersonalData::query()
                ->where('cesno', "LIKE" ,"%$search%")
                ->orWhere('lastname',  "LIKE","%$search%")
                ->orWhere('firstname',  "LIKE","%$search%")
                ->orWhere('middlename',  "LIKE","%$search%")
                ->orWhere('name_extension',  "LIKE","%$search%")
                ->get();

            // validating if $search is not equal to null and the value is numeric
            if ($search !== null && trim($search) !== '' && is_numeric($search)) 
            {
                // Query the database to find the corresponding personal data
                $personalDataSearchResult = PersonalData::where('cesno', $search)->first();

                if (!$personalDataSearchResult || !is_numeric($search)) 
                {
                    // Handle the case where the data does not exist
                    return redirect()->route('training-session.createParticipant')->with('error', 'Data not found in the database.');
                }
            }
            else
            {
                $personalDataSearchResult = null;
            }

            // retrieving personal data latest ces status
                $personalData = PersonalData::first()->find($search);

                if ($personalData) 
                {
                    $latestCesStatus = $personalData->profileTblCesStatus()->latest()->first();

                    if ($latestCesStatus !== null) 
                    {
                        $latestCesStatusCode = $latestCesStatus->cesstat_code;
                            
                        $description = ProfileLibTblCesStatus::where('code', $latestCesStatusCode)->value('description');
                    } 
                    else 
                    {
                        // Handle the case where $latestCesStatus is null
                        $description = null; // or provide a default value if needed
                    }
                }      
                else 
                {
                    // Handle the case where $personalData is null
                    $description = null; // or provide a default value if needed
                }
            // end of retrieving personal data latest ces status    
            
            return view('admin.competency.partials.training_session.participant_form', ['personalData' => $searchPersonalData, 'personalDataSearchResult' => 
            $personalDataSearchResult, 'search' => $search, 'description' => $description, 'sessionId' => $sessionId]);
        }

        public function storeParticipant(Request $request, $sessionId)
        {
            $request->validate([

                'status' => ['required'],
                'remarks' => ['nullable'],
                'no_of_hours' => ['required'],
                'payment' => ['required'],
                
            ]);
    
            /** @var \App\Models\User $user */
            $user = Auth::user();
            $encoder = $user->userName();
    
            $trainingParticipant = new TrainingParticipants([
    
                'cesno' => $request->cesno,
                'sessionid' => $sessionId,
                'status' => $request->status,
                'remarks' => $request->remarks,
                'no_hours' => $request->no_of_hours,
                'payment' => $request->payment,
                'encoder' =>  $encoder,
    
            ]);
    
            $personalData = PersonalData::find($request->cesno);
            
            $personalData->competencyCesTraining()->save($trainingParticipant);

            return to_route('training-session.addParticipant', ['sessionId'=>$sessionId])->with('message', 'Save Sucessfully');
        }

        public function destroyParticipant($pid)
        {
            $trainingParticipant = TrainingParticipants::find($pid);
            $trainingParticipant->delete();

            return back()->with('message', 'Participant Record Deleted Sucessfully');
        }

        public function recentlyDeletedParticipant()
        {
            $trainingParticipantTrashedRecord =  TrainingParticipants::onlyTrashed()->get();
        
            return view('admin.competency.partials.training_session.participant_trashbin', compact('trainingParticipantTrashedRecord'));
        }

        public function restoreParticipantList($pid)
        {
            $trainingParticipantTrashedRecord = TrainingParticipants::onlyTrashed()->find($pid);
            $trainingParticipantTrashedRecord->restore();

            return back()->with('info', 'Participant\'s Record Sucessfully');
        }

        public function forceDeleteParticipantList($pid)
        {
            $trainingParticipantTrashedRecord = TrainingParticipants::onlyTrashed()->find($pid);
            $trainingParticipantTrashedRecord->forceDelete();
    
            return back()->with('info', 'Participant\'s Record Permanently Deleted');
        }
    // end of training session participant methods
}
