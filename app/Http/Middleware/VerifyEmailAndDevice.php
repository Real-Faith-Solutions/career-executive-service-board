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

        // Get an array of current device identifiers
        $deviceIdentifiers = $this->getCurrentDeviceIdentifiers();

        // Check if the user's email is verified for any of the current device identifiers
        if (!$this->isEmailConfirmedForDevice($associations, $deviceIdentifiers, $request->user())) {
            return redirect()->route('reconfirm.email');
        }

        return $next($request);
    }

    protected function isEmailConfirmedForDevice($associations, $deviceIdentifiers, $user)
    {
        foreach ($deviceIdentifiers as $deviceIdentifier) {
            foreach ($associations as $association) {
                if (
                    $association['device_id'] === $deviceIdentifier &&
                    $association['user_id'] === $user->id &&
                    $association['verified']
                ) {
                    return true; // Email is confirmed for at least one device identifier
                }
            }
        }

        return false; // Email is not confirmed for any of the device identifiers
    }

    protected function getCurrentDeviceIdentifiers()
    {
        // Implement logic to get an array of current device identifiers.
        // Return an array of strings.
    }
}
