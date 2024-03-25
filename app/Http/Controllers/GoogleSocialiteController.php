<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Laravel\Socialite\Facades\Socialite;
use Auth;
use Exception;
use App\Models\User;

class GoogleSocialiteController extends Controller
{
    /**
     * Redirect the user to the Google authentication page.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function redirectToGoogle()
{
    return Socialite::driver('google')->redirect()->getTargetUrl();
}
  
    /**
     * Obtain the user information from Google.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function handleCallback()
    {
        try {
            $user = Socialite::driver('google')->user();
            
            // Check if the user already exists in the database
            $findUser = User::where('email', $user->email)->first();
            
            if (!$findUser) {
                
                return redirect()->back()->with('error', 'No access. Please contact the administrator.');
              
            }
            Auth::login($findUser);

            $token = $findUser->createToken('remember_token')->plainTextToken;
            return response()->json([
                'success' => true,
                'token' => $token,
                'Type' => 'Bearer',
                'user' => $findUser,
                'name' => $findUser->name,
            ]);

            
        } catch (Exception $e) {
            // Handle exceptions
            dd($e->getMessage());
        }
    }
}
