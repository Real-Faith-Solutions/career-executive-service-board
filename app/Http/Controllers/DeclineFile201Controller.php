<?php

namespace App\Http\Controllers;

use App\Models\RequestFile;
use Illuminate\Http\Request;

class DeclineFile201Controller extends Controller
{
    public function index($cesno)
    {
        $pendingFileTrashedRecord = RequestFile::onlyTrashed()
                                ->where('personal_data_cesno', $cesno)
                                ->get();

        return view('admin.201_profiling.view_profile.partials.pdf_files.decline_file201.declined_files', [
            'cesno' => $cesno,
            'pendingFileTrashedRecord' => $pendingFileTrashedRecord,
        ]);
    }
}
