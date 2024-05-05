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
        return Socialite::driver('google')->redirect();
    }
  
    public function handleCallback()
    {
        try {
    
            $user = Socialite::driver('google')->stateless()->user();
        
            $finduser = User::where('email', $user->email)->first();
     
            if($finduser){
     
                Auth::login($finduser);
                $token = $finduser->createToken('remember_token')->plainTextToken;
                $finduser->update(['remember_token' => $token]); 
                if ($finduser->role === "Resident" && $finduser->branch === "Dormitory" )
                {
                    return redirect('/resident/announcements');
                }else if ($finduser->role === "Resident" && $finduser->branch === "Hostel")
                {
                    return redirect('/resident/announcements');
                }
                else
                {
                    return redirect('/admin/dorm/dashboard');
                }

     
            }else{
               
     
                return redirect('/login');
            }
    
        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }

    // public function handleCallbackMobile()
    // {
    //         $user = Socialite::driver('google')->stateless()->user();
    //         return response()->json($user, 200);
    // }

}