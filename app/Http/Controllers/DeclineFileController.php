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

    // decline file
    public function declineFile($ctrlno)
    {
        $pendingFile = RequestFile::find($ctrlno);
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
