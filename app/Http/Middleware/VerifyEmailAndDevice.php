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

        // Check if the user's email is verified for the current device
        $deviceIdentifier = $this->getCurrentDeviceIdentifier();

        if (!$this->isEmailConfirmedForDevice($associations, $deviceIdentifier, $request->user())) {
            return redirect()->route('reconfirm.email');
        }

        return $next($request);
    }

    protected function isEmailConfirmedForDevice($associations, $deviceIdentifier, $user)
    {
        foreach ($associations as $association) {
            if (
                $association['device_id'] === $deviceIdentifier &&
                $association['user_id'] === $user->id &&
                $association['verified']
            ) {
                return true;
            }
        }

        return false;
    }
}
