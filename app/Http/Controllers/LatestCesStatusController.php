<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LatestCesStatusController extends Controller
{
    public function latestCesStatus($personalData)
    {
        if ($personalData) 
        {
            $latestCesStatus = $personalData->cesStatus()->first();

            if ($latestCesStatus != null) 
            {
                $description = $latestCesStatus->description;
            } 
            else 
            {
                // Handle the case where $latestCesStatus is null
                $description = null; // or provide a default value if needed
            }
        }      
        else 
        {
            return redirect()->back()->with('error', 'Personal Data Not Found!!');
        }

        return $description;
    }
}
