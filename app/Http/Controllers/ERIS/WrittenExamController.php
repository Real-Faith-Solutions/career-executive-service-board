<?php

namespace App\Http\Controllers\Eris;

use App\Http\Controllers\Controller;
use App\Models\Eris\EradTblMain;
use App\Models\Eris\WrittenExam;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class WrittenExamController extends Controller
{
    public function index($acno)
    {
        $writtenExam = WrittenExam::where('acno', $acno)->paginate(25);

        return view('admin.eris.partials.written_exam.table', compact('acno', 'writtenExam'));
    }

    public function create($acno)
    {
        $erisTblMainProfileData =  EradTblMain::find($acno);

        return view('admin.eris.partials.written_exam.form', compact('acno', 'erisTblMainProfileData'));
    }

    public function store(Request $request, $acno)
    {
        $request->validate([
            'we_date' => ['required'],
            'we_location' => ['nullable', 'max:60', 'min:2'],
            'we_rating' => ['required'],
            'we_remarks' => ['nullable', 'max:60', 'min:2', 'regex:/^[a-zA-Z0-9\s]*$/'],
        ]);
            
        /** @var \App\Models\User $user */
        $user = Auth::user();
        $encoder = $user->userName();

        $writtenExam = new WrittenExam([

            'acno' => $request->acno, // account number from erad_tblMain
            'we_date' => $request->we_date, // written exam date
            'we_location' => $request->we_location, // written exam location
            'we_rating' => $request->we_rating, // written exam rating
            'we_remarks' => $request->we_remarks, // written exam remarks
            'numtakes' => $request->numtakes, // written exam number of takes
            'encoder' =>  $encoder,

        ]);

        $erisTblMain = EradTblMain::find($request->acno);
        
        $erisTblMain->writtenExam()->save($writtenExam);
        
        return to_route('eris-written-exam.index', ['acno'=>$acno])->with('message', 'Save Sucessfully');
    }

    public function edit($acno, $ctrlno)
    {
       $erisTblMainProfileData =  EradTblMain::find($acno);
       $writtenExamPRofileData = WrittenExam::find($ctrlno); 

       return view('admin.eris.partials.written_exam.edit', compact('acno', 'erisTblMainProfileData', 'writtenExamPRofileData', 'ctrlno')); 
    }

    public function update(Request $request, $acno, $ctrlno)
    {
        $request->validate([

            'we_date' => ['required'],
            'we_location' => ['nullable', 'max:60', 'min:2'],
            'we_rating' => ['required'],
            'we_remarks' => ['nullable', 'max:60', 'min:2', 'regex:/^[a-zA-Z0-9\s]*$/'],
            
        ]);
        
        $writtenExam = WrittenExam::find($ctrlno);
        $writtenExam->we_date = $request->we_date;
        $writtenExam->we_location = $request->we_location;
        $writtenExam->we_rating = $request->we_rating;
        $writtenExam->we_remarks = $request->we_remarks;
        $writtenExam->update();

        return to_route('eris-written-exam.index', ['acno'=>$acno])->with('info', 'Update Sucessfully');
    }

    public function destroy($ctrlno)
    {
       $writtenExam = WrittenExam::find($ctrlno);
       $writtenExam->delete();

       return back()->with('message', 'Deleted Sucessfully');
    }

    public function recentlyDeleted($acno)
    {
        //parent model
        $erisTblMainData = EradTblMain::withTrashed()->find($acno);

        // Access the soft deleted writtenExam of the parent model
        $writtenExamTrashedRecord = $erisTblMainData->writtenExam()->onlyTrashed()->get();
 
        return view('admin.eris.partials.written_exam.trashbin', compact('writtenExamTrashedRecord', 'acno'));
    }

    public function restore($ctrlno)
    {
        $writtenExamTrashedRecord = WrittenExam::onlyTrashed()->find($ctrlno);
        $writtenExamTrashedRecord->restore();

        return back()->with('info', 'Data Restored Sucessfully');
    }

    public function forceDelete($ctrlno)
    {
        $writtenExamTrashedRecord = WrittenExam::onlyTrashed()->find($ctrlno);
        $writtenExamTrashedRecord->forceDelete();
  
        return back()->with('info', 'Data Permanently Deleted');
    }
}
