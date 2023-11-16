<?php

namespace App\Http\Controllers;

use App\Models\RequestFile;
use Illuminate\Http\Request;

class DeclineFileController extends Controller
{
    // show soft deleted decline file
    public function recentlyDeclineFile()
    {
        $pendingFileTrashedRecord = RequestFile::onlyTrashed()->get();

        return view('admin.201_profiling.view_profile.partials.pdf_files.declineFilesTrashbin', compact('pendingFileTrashedRecord'));
    }

    public function restore($ctrlno)
    {
        $pendingFile = RequestFile::onlyTrashed($ctrlno);
        $pendingFile->restore();

        return back()->with('info', 'File Restored Successfully');
    }

    // decline file
    public function declineFile(Request $request)
    {
        $ctrlno = $request->decline_file_ctrlno;
        $cesno = $request->decline_file_personal_data_cesno;
        $reason = $request->decline_file_reason;
        $pendingFile = RequestFile::find($ctrlno);
        $pendingFile->update(['reason' => $reason]);
        $pendingFile->delete();

        return back()->with('message', 'Deleted Sucessfully');
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
}
