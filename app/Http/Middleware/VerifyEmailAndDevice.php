<?php

namespace App\Http\Middleware;

use App\Models\DeviceVerification;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Symfony\Component\HttpFoundation\Response;

class VerifyEmailAndDevice
{
    public function handle($request, Closure $next)
    {
        // Retrieve associations from the cookie
        $associations = json_decode(Cookie::get('user_device_associations'), true) ?: [];

        $ctrlno = auth()->user()->ctrlno;
        $deviceIdentifiers = $this->getCurrentDeviceIdentifiers($ctrlno);

        // Check if the user's email is verified for any of the current device identifiers
        if (!$this->isEmailConfirmedForDevice($associations, $deviceIdentifiers, $ctrlno)) {
            return redirect()->route('reconfirm.email');
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
}
