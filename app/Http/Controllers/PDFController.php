<?php

namespace App\Http\Controllers;

use App\Models\ApprovedFile;
use App\Models\PdfLinks;
use App\Models\PersonalData;
use App\Models\RequestFile;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class PDFController extends Controller
{
    public function index($cesno)
    {
        $personalData = PersonalData::find($cesno);
        $approvedPdfFile = $personalData->pdfFile;

        return view('admin.201_profiling.view_profile.partials.pdf_files.table', compact('approvedPdfFile', 'cesno'));
    }

    public function pendingFiles()
    {
        $pdfFile = RequestFile::all();

        return view('admin.201_profiling.view_profile.partials.pdf_files.pendingFileTable', compact('pdfFile'));
    }

    public function create($cesno)
    {
        return view('admin.201_profiling.view_profile.partials.pdf_files.form', compact('cesno'));
    }

    //store requested file 
    public function store(Request $request, $cesno)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        $encoder = $user->userName(); 

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
        if ($request->hasFile('pdfFile')) 
        {
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
                'encoder' => $encoder,
                 
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
    public function acceptedFiles($ctrlno, $cesno)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        $encoder = $user->userName(); 

        $personalData = PersonalData::find($cesno);
        $lastName = $personalData->lastname;
        $firstName = $personalData->firstname;
        $mI = $personalData->mi;
        $nameExtension = $personalData->name_extension;
        $personalDataFullName = $lastName." ".$firstName." ".$mI." ".$nameExtension;
        
        // getting the first data 
        $requestFile = RequestFile::find($ctrlno)->first(); 

        // holds the path file name
        $pdfFile = $requestFile->request_pdflink; 

        // holds the original file name
        $originalPdfFile = $requestFile->request_pdflink_orignal_name; 

        // getting day created and encoder
        $requestDate = $requestFile->created_at; 
        $requestedBy = $requestFile->encoder; 

        // holds the pending file path
        $databasePath = $pdfFile; 
    
        // Generate a unique name for the document
        $pdfFileName = date('m-d-y').'_'.$personalDataFullName.'_'.time().'_'.$originalPdfFile; 

        // source path
        $sourcePath = public_path($databasePath); 

        // destination path
        $destinationPath = public_path('pdf_files/'.$pdfFileName); 

        // path name
        $pdfPathName = 'pdf_files/'.$pdfFileName; 

        // copy the source path to destination path
        File::copy($sourcePath, $destinationPath); 

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
            'encoder' => $encoder,
                 
        ]);
        
        //find personal data cesno
        $pdfFilePersonalDataId = PersonalData::find($requestFile->personal_data_cesno);
        
        // Save the file path and data to the database
        $pdfFilePersonalDataId->pdfFile()->save($pdf);
        
        // store approve file in approved_file
        $approvePdf = new ApprovedFile([
            
            'pdflink' => $pdfPathName,
            'original_pdflink' => $pdfFileName,
            'remarks' => $requestFile->remarks,
            'request_date' => $requestDate,
            'requested_by' => $requestedBy,
            'encoder' => $encoder,
         
        ]);

        //find personal data cesno
        $approvedfFilePersonalDataId = PersonalData::find($requestFile->personal_data_cesno);
        
        // Save the approved file path and data to the approved_file
        $approvedfFilePersonalDataId->approvedFile()->save($approvePdf);

        //delete existing file from request_file table
        DB::table('request_file')->where('ctrlno', $requestFile->ctrlno)->delete();

        return back()->with('message','Document Approved successfully');
    }

    // stream approved file
    public function download($ctrlno)
    {
        $pdfFileName = PdfLinks::withTrashed()->where('ctrlno', $ctrlno)->value('pdflink');

        $myFile = public_path($pdfFileName);

        return response()->file($myFile);
    }

    // stream pending file
    public function downloadPendingFile($ctrlno)
    {
        $pendingPdfFileName = RequestFile::withTrashed()->where('ctrlno', $ctrlno)->value('request_pdflink');

        $pendingFile = public_path($pendingPdfFileName);
        
        return response()->file($pendingFile);
    }

    // show soft deleted approved file by user
    public function recentlyDeleted($cesno)
    {
        //parent model
        $personalData = PersonalData::withTrashed()->find($cesno);

        // Access the soft deleted pdfFile of the parent model
        $pdfFileTrashedRecord = $personalData->pdfFile()->onlyTrashed()->get();

        return view('admin.201_profiling.view_profile.partials.pdf_files.approvedFileTrashbin', compact('pdfFileTrashedRecord' ,'cesno'));
    }

    // soft deleting approved file by user
    public function destroy($ctrlno)
    {
        $pdfFile = PdfLinks::find($ctrlno);
        $pdfFile->delete();

        return back()->with('message', 'Deleted Sucessfully');
    }

    // permanently delete approve file by user
    public function forceDelete($ctrlno)
    {
        $pdfFile = PdfLinks::onlyTrashed()->find($ctrlno);

        $existingApprovedFile = $pdfFile->pdflink;

         // Delete the existing file from the storage folder
         if ($existingApprovedFile) {
            $filePath = public_path($existingApprovedFile);
            if (file_exists($filePath)) {
                unlink($filePath);
            }
        }

        $pdfFile->forceDelete();
  
        return back()->with('message', 'Data Permanently Deleted');
    }

    // restore approved file by user
    public function restore($ctrlno)
    {
        $pdfFile = PdfLinks::onlyTrashed()->find($ctrlno);
        $pdfFile->restore();

        return back()->with('message', 'Data Restored Sucessfully');
    }

    // decline file
    public function declineFile($ctrlno)
    {
        $pendingFile = RequestFile::find($ctrlno);
        $pendingFile->delete();

        return back()->with('message', 'Deleted Sucessfully');
    }

    // show soft deleted decline file
    public function recentlyDeclineFile()
    {
        $pendingFileTrashedRecord = RequestFile::onlyTrashed()->get();

        return view('admin.201_profiling.view_profile.partials.pdf_files.declineFilesTrashbin', compact('pendingFileTrashedRecord'));
    }

    // permanently deleting soft deleted declined file 
    public function declineFileForceDelete($ctrlno)
    {
        $declineFile = RequestFile::onlyTrashed()->find($ctrlno);

        // getting pending file path name
        $existingDeclineFile = $declineFile->request_pdflink;

        // Delete the existing file from the storage folder
        if ($existingDeclineFile) 
        {
            $filePath = public_path($existingDeclineFile);
            if (file_exists($filePath)) {
                unlink($filePath);
            }
        }

        $declineFile->forceDelete();
  
        return back()->with('message', 'Data Permanently Deleted');
    }

    public function approvedFile()
    {
        $approvedFile = ApprovedFile::paginate(25);

        return view('admin.201_profiling.view_profile.partials.pdf_files.approveFileTable', compact('approvedFile'));
    }

    public function streamApprovedFile($ctrlno)
    {
        $pdfFileName = ApprovedFile::withTrashed()->where('ctrlno', $ctrlno)->value('pdflink');

        $myFile = public_path($pdfFileName);

        return response()->file($myFile);
    }
}

