<?php

namespace App\Http\Middleware;

use App\Mail\ConfirmationCodeMail;
use App\Models\DeviceVerification;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Symfony\Component\HttpFoundation\Response;

class VerifyEmailAndDevice
{
    public function handle($request, Closure $next)
    {
        if(!auth()->user()->two_factor){
            return $next($request);
        }

        // Retrieve associations from the cookie
        $associations = json_decode(Cookie::get('user_device_associations'), true) ?: [];

        $ctrlno = auth()->user()->ctrlno;
        $deviceIdentifiers = $this->getCurrentDeviceIdentifiers($ctrlno);
        $pendingIdentifiers = $this->getPendingDeviceIdentifiers($ctrlno);

        // Check if the user's email is verified for any of the current device identifiers
        if (!$this->isEmailConfirmedForDevice($associations, $deviceIdentifiers, $ctrlno)) {

            if($pendingDeviceIdentifiers = $this->checkPendingConfirmation($associations, $pendingIdentifiers, $ctrlno)){
                
                $deviceVerification = DeviceVerification::where('user_ctrlno', $ctrlno)->where('device_id', $pendingDeviceIdentifiers)->first();
                $cooldownMinutes = 60; // Adjust as needed
                if ($deviceVerification && $deviceVerification->updated_at->addMinutes($cooldownMinutes)->isFuture()) {
                    return redirect()->route('reconfirm.email')->with('info','Enter Confirmation Code. Please check your email');
                }

                $confirmation_code = mt_rand(10000, 99999);
                $hashed_confirmation_code = Hash::make($confirmation_code);
                $recipientEmail = auth()->user()->email;
                $imagePath = public_path('images/branding.png');

                // Update the confirmation code in the database
                $deviceVerification->update(['confirmation_code' => $hashed_confirmation_code]);

                // sending confirmation_code email to user
                $data = [
                    'email' => $recipientEmail,
                    'confirmation_code' => $confirmation_code,
                    'imagePath' => $imagePath,
                ];
        
                Mail::to($recipientEmail)->send(new ConfirmationCodeMail($data));

                return redirect()->route('reconfirm.email')->with('info','Enter Confirmation Code. Please check your email');
            }

            $device_id = uniqid();
            $confirmation_code = mt_rand(10000, 99999);
            $hashed_confirmation_code = Hash::make($confirmation_code);
            $recipientEmail = auth()->user()->email;
            $imagePath = public_path('images/branding.png');

            DeviceVerification::create([
                'user_ctrlno' => $ctrlno,
                'confirmation_code' => $hashed_confirmation_code,
                'device_id' => $device_id,
                'verified' => false, // Set verified to false initially
            ]);

            // sending confirmation_code email to user
            $data = [
                'email' => $recipientEmail,
                'confirmation_code' => $confirmation_code,
                'imagePath' => $imagePath,
            ];
    
            Mail::to($recipientEmail)->send(new ConfirmationCodeMail($data));

            // Add the new association to the array
            $associations[] = [
                'user_id' => $ctrlno,
                'device_id' => $device_id,
                'verified' => false, // Set verified to false initially
            ];

            Cookie::queue(Cookie::make('user_device_associations', json_encode($associations), 30 * 24 * 60));

            return redirect()->route('reconfirm.email')->with('info','Enter Confirmation Code. Please check your email');
        }

        return $next($request);
    }

    protected function isEmailConfirmedForDevice($associations, $deviceIdentifiers, $ctrlno)
    {
        foreach ($deviceIdentifiers as $deviceIdentifier) {
            foreach ($associations as $association) {
                if (
                    $association['device_id'] === $deviceIdentifier &&
                    $association['user_id'] === $ctrlno &&
                    $association['verified']
                ) {
                    return true;
                }
            }
        }

        return false;
    }

    protected function getCurrentDeviceIdentifiers($ctrlno)
    {
        return DeviceVerification::where('user_ctrlno', $ctrlno)
            ->where('verified', true)
            ->pluck('device_id')
            ->toArray();
    }

    protected function getPendingDeviceIdentifiers($ctrlno)
    {
        return DeviceVerification::where('user_ctrlno', $ctrlno)
            ->where('verified', false)
            ->pluck('device_id')
            ->toArray();
    }

    protected function checkPendingConfirmation($associations, $pendingIdentifiers, $ctrlno)
    {
        foreach ($pendingIdentifiers as $pendingIdentifier) {
            foreach ($associations as $association) {
                if (
                    $association['device_id'] === $pendingIdentifier &&
                    $association['user_id'] === $ctrlno
                ) {
                    return $association['device_id'];
                }
            }
        }

        return false;
    }

}
