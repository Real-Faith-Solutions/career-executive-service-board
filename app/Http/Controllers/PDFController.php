<?php

namespace App\Http\Controllers;

use App\Models\PdfLinks;
use App\Models\PersonalData;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class PDFController extends Controller
{
    public function show($cesno){

        return view('admin.201_profiling.view_profile.partials.pdf_files.form', compact('cesno'));

    }

    public function store(Request $request, $cesno){

        $userFullName = Auth::user();
        $userLastName = $userFullName ->last_name;
        $userFirstName = $userFullName ->first_name;
        $userMiddleName = $userFullName ->middle_name;
        $userNameExtension = $userFullName ->name_extension;

        $validator = Validator::make($request->all(), [
            'pdfFile' => 'required|mimes:pdf',
        ]);
    
        if ($validator->fails()) {
            return back()->with('error','Invalid file type!');
        }

        //check if file was uploaded
        if ($request->hasFile('pdfFile')) {

            $pdfFile = $request->file('pdfFile');

            // Get the current date in the format mm-dd-yy
            $currentDateFormatted = Carbon::now()->format('m-d-y');

            // Generate a unique name for the document
            $pdfFileName = $currentDateFormatted . '_' . date('h-i-A') . '_' . $pdfFile->getClientOriginalName();

            // Move the uploaded document to the desired location
            $pdfFile->move(public_path('pdf_files'), $pdfFileName);

            $pdfPathName = 'pdf_files/'.$pdfFileName;

            $pdf = new PdfLinks([
    
                'personal_data_cesno' => $request->$cesno,
                'pdflink' => $pdfPathName,
                'remarks' => $request->remarks,
                'encoder' => $userLastName." ".$userFirstName." ".$userMiddleName." ".$userNameExtension,
                 
            ]);
        
            //find personal data cesno
            $pdfFilePersonalDataId = PersonalData::find($cesno);
        
            // Save the file path and data to the database
            $pdfFilePersonalDataId->affiliations()->save($pdf);

            return back()->with('message','Document uploaded successfully');

        }

        // Handle the case when no file was uploaded
        return back()->with('error','No file was uploaded!');

    }
}
