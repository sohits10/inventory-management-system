<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Log;

class CustomAuthenticatedSessionController extends Controller
{
    /**
     * Handle an incoming authentication request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Log::info('Login attempt', ['email' => $request->email]);

        // Validate the request...
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Attempt to authenticate the user...
        if (!Auth::attempt($request->only('email', 'password'))) {
            throw ValidationException::withMessages([
                'email' => 'The provided credentials do not match our records.',
            ]);
        }

        // Regenerate the session...
        $request->session()->regenerate();

        // Store the user ID in the session
        session(['user_id' => Auth::id()]);
        
        // Log::info('Login successful', [
        //     'email' => $request->email,
        //     'user_id' => Auth::id(),
        //     'session_data' => session()->all(), // Log all session data for debugging
        // ]);

        // Redirect to intended route...
        // return redirect()->intended('dashboard'); // Change this to your desired route

        return redirect()->intended($request->input('/', 'reservations')); // Redirect back to the intended URL or dashboard

    }

    /**
     * Log the user out of the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/'); // Change this to your desired route
    }
}
