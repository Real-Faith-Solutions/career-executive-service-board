<?php

namespace App\Http\Controllers;

use App\Models\PdfLinks;
use App\Models\PersonalData;
use App\Models\RequestFile;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class PDFController extends Controller
{

    public function index($cesno){

        $personalData = PersonalData::find($cesno);
        $approvedPdfFile = $personalData->pdfFile;

        return view('admin.201_profiling.view_profile.partials.pdf_files.table', compact('approvedPdfFile', 'cesno'));

    }

    public function pendingFiles(){
     
        $pdfFile = RequestFile::all();

        return view('admin.201_profiling.view_profile.partials.pdf_files.pendingFileTable', compact('pdfFile'));
        
    }

    public function create($cesno){

        return view('admin.201_profiling.view_profile.partials.pdf_files.form', compact('cesno'));

    }

    //store requested file 
    public function store(Request $request, $cesno){

        $userFullName = Auth::user();
        $userLastName = $userFullName ->last_name;
        $userFirstName = $userFullName ->first_name;
        $userMiddleName = $userFullName ->middle_name;
        $userNameExtension = $userFullName ->name_extension;
        $userFullName = $userLastName." ".$userFirstName." ".$userMiddleName." ".$userNameExtension;

        $personalData = PersonalData::find($cesno);
        $lastName = $personalData->lastname;
        $firstName = $personalData->firstname;
        $mI = $personalData->mi;
        $nameExtension = $personalData->name_extension;
        $personalDataFullName = $lastName." ".$firstName." ".$mI." ".$nameExtension; 

        $validator = Validator::make($request->all(), [
            'pdfFile' => 'required|mimes:pdf',
        ]);
    
        if ($validator->fails()) {
            return back()->with('error','Invalid file type!');
        }

        //check if file was uploaded
        if ($request->hasFile('pdfFile')) {

            $pdfFile = $request->file('pdfFile');

            // Generate a unique name for the document
            $pdfFileName = date('m-d-y').'_'.$personalDataFullName.'_'.time().'_'.$pdfFile->getClientOriginalName();

            //file name orignal name
            $originalFileName = $pdfFile->getClientOriginalName();

            // Move the uploaded document to the desired location
            $pdfFile->move(public_path('pending_pdf_files'), $pdfFileName);

            $pdfPathName = 'pending_pdf_files/'.$pdfFileName;

            $pdf = new RequestFile([
    
                'request_pdflink' => $pdfPathName,
                'request_pdflink_orignal_name' => $originalFileName,
                'request_unique_file_name' => $pdfFileName,
                'remarks' => $request->remarks,
                'encoder' => $userFullName,
                 
            ]);
        
            //find personal data cesno
            $pdfFilePersonalDataId = PersonalData::find($cesno);
        
            // Save the file path and data to the database
            $pdfFilePersonalDataId->requestFile()->save($pdf);

            return to_route('show-pdf-files.index', ['cesno'=>$cesno])->with('message','Document uploaded successfully');

        }

        // Handle the case when no file was uploaded
        return back()->with('error','No file was uploaded!');

    }

    //store accepted file
    public function acceptedFiles($ctrlno, $cesno){

        $userFullName = Auth::user();
        $userLastName = $userFullName ->last_name;
        $userFirstName = $userFullName ->first_name;
        $userMiddleName = $userFullName ->middle_name;
        $userNameExtension = $userFullName ->name_extension;
        $userFullName = $userLastName." ".$userFirstName." ".$userMiddleName." ".$userNameExtension;

        $personalData = PersonalData::find($cesno);
        $lastName = $personalData->lastname;
        $firstName = $personalData->firstname;
        $mI = $personalData->mi;
        $nameExtension = $personalData->name_extension;
        $personalDataFullName = $lastName." ".$firstName." ".$mI." ".$nameExtension;
        
        $requestFile = RequestFile::find($ctrlno)->first(); // getting the first data 
        $pdfFile = $requestFile->request_pdflink; // holds the path file name
        $originalPdfFile = $requestFile->request_pdflink_orignal_name; // holds the original file name
        $requestDate = $requestFile->created_at; 
        $requestedBy = $requestFile->encoder; 

        $databasePath = $pdfFile; // holds the pending file path
    
        $pdfFileName = date('m-d-y').'_'.$personalDataFullName.'_'.time().'_'.$originalPdfFile; // Generate a unique name for the document

        $sourcePath = public_path($databasePath); // source path
        $destinationPath = public_path('pdf_files/'.$pdfFileName); // destination path

        $pdfPathName = 'pdf_files/'.$pdfFileName; // path name

        File::copy($sourcePath, $destinationPath); // copy the source path to destination path

        $existingRequestedFile = $requestFile->request_pdflink;

        // Delete the existing file from the storage folder
        if ($existingRequestedFile) {
            $filePath = public_path($existingRequestedFile);
            if (file_exists($filePath)) {
                unlink($filePath);
            }
        }

        $pdf = new PdfLinks([
    
            'pdflink' => $pdfPathName,
            'original_pdflink' => $pdfFileName,
            'remarks' => $requestFile->remarks,
            'request_date' => $requestDate,
            'requested_by' => $requestedBy,
            'encoder' => $userFullName,
                 
        ]);
        
        //find personal data cesno
        $pdfFilePersonalDataId = PersonalData::find($requestFile->personal_data_cesno);
        
        // Save the file path and data to the database
        $pdfFilePersonalDataId->pdfFile()->save($pdf);;

        //delete existing file from request_file table
        DB::table('request_file')->where('ctrlno', $requestFile->ctrlno)->delete();

        return back()->with('message','Document Approved successfully');
    }

    // download approved file
    public function download($ctrlno){

        $pdfFileName = PdfLinks::where('ctrlno', $ctrlno)->value('pdflink');

        $myFile = public_path($pdfFileName);
        
        return response()->download($myFile);

    }

    // download pending file
    public function downloadPendingFile($ctrlno){

        $pendingPdfFileName = RequestFile::where('ctrlno', $ctrlno)->value('request_pdflink');

        $pendingFile = public_path($pendingPdfFileName);
        
        return response()->download($pendingFile);

    }

    // store decline file
    // public function declineFile($ctrlno){

    //     $requestFile = RequestFile::find($ctrlno)->first(); // getting the first data 
    //     $pdfFile = $requestFile->request_pdflink; // holds the path file name
    //     $originalPdfFile = $requestFile->request_pdflink_orignal_name; // holds the original file name
    //     $requestDate = $requestFile->created_at; 
    //     $requestedBy = $requestFile->encoder; 

    //     $databasePath = $pdfFile; // holds the pending file path

    //     $sourcePath = public_path($databasePath); // source path
    //     $destinationPath = public_path('decline_pdf_files/'.$pdfFileName); // destination path

    //     $pdfPathName = 'pdf_files/'.$pdfFileName; // path name

    //     File::copy($sourcePath, $destinationPath); // copy the source path to destination path


    //     $pdf = new PdfLinks([
    
    //         'pdflink' => $pdfPathName,
    //         'original_pdflink' => $pdfFileName,
    //         'remarks' => $requestFile->remarks,
    //         'request_date' => $requestDate,
    //         'requested_by' => $requestedBy,
    //         'encoder' => $userFullName,
                 
    //     ]);
        
    //     //find personal data cesno
    //     $pdfFilePersonalDataId = PersonalData::find($requestFile->personal_data_cesno);
        
    //     // Save the file path and data to the database
    //     $pdfFilePersonalDataId->pdfFile()->save($pdf);;

    //     //delete existing file from request_file table
    //     DB::table('request_file')->where('ctrlno', $requestFile->ctrlno)->delete();

    // }
}
