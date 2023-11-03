<?php

namespace App\Http\Controllers;

use App\Models\ApprovedFile;
use Illuminate\Http\Request;

class ApprovedFileController extends Controller
{
    public function approvedFile()
    {
        $approvedFile = ApprovedFile::paginate(25);

        return view('admin.201_profiling.view_profile.partials.pdf_files.approveFileTable', compact('approvedFile'));
    }

    public function streamApprovedFile($ctrlno)
    {
        $pdfFileName = ApprovedFile::where('ctrlno', $ctrlno)->value('pdflink');

        $myFile = public_path($pdfFileName);

        return response()->file($myFile);
    }

    public function destroy($ctrlno)
    {
        $approvedFile = ApprovedFile::find($ctrlno);
        $approvedFile->delete();

        return back()->with('message', 'Deleted Sucessfully');
    }
}
