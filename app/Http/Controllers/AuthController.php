<?php

namespace App\Http\Controllers;

/* use Kreait\Firebase\Auth;
use Kreait\Firebase\Exception\Auth\InvalidPassword;
use Kreait\Firebase\Exception\Auth\UserNotFound; */

use Illuminate\Http\Request;

class AuthController extends Controller
{
    /* protected $firebaseAuth;

    public function __construct(Auth $firebaseAuth)
    {
        $this->firebaseAuth = $firebaseAuth;
    } */

    public function showLoginForm()
    {
        return view('admin.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        try {
            $user = $this->firebaseAuth->signInWithEmailAndPassword($credentials['email'], $credentials['password']);
            // Successfully logged in, redirect to dashboard or desired page
            return redirect()->route('dashboard');
        } catch (UserNotFound $e) {
            return redirect()->back()->withErrors(['email' => 'Invalid credentials']);
        } catch (InvalidPassword $e) {
            return redirect()->back()->withErrors(['password' => 'Invalid credentials']);
        }
    }

    public function logout()
    {
        $this->firebaseAuth->signOut();
        // Redirect to login page or desired page
        return redirect()->route('login');
    }
}
