<?php

namespace App\Http\Middleware;

use Closure;
use Kreait\Firebase\Factory;
use Kreait\Firebase\ServiceAccount;

class FirebaseAuthMiddleware
{
    public function handle($request, Closure $next)
    {
        // Get the UID from the request
        $uid = $request->header('X-User-UID');

        // Verify the UID using the Firebase Admin SDK
        $serviceAccount = ServiceAccount::fromJsonFile(config_path('firebase_credentials.json'));
        $firebase = (new Factory)
            ->withServiceAccount($serviceAccount)
            ->create();

        $auth = $firebase->getAuth();
        $user = $auth->getUser($uid);

        // Check if the user is authenticated
        if ($user) {
            // User is authenticated, continue with the request
            return $next($request);
        } else {
            // User is not authenticated, return an error response or redirect as desired
            return response('Unauthorized', 401);
        }
    }
}
