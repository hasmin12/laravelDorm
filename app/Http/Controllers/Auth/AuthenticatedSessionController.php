<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
use App\Models\User;
use App\Models\Notification;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     *
     * @param  \App\Http\Requests\Auth\LoginRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $data = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);
        // dd($data);

        $user = User::where('email', $data['email'])->first();
        if (!$user || $user->status !== 'active') {
            return back()->with('error', 'Your account is not active. Please contact support.');
        }


        if (Auth::attempt(['email' => $data['email'], 'password' => $data['password']])) {
            $request->session()->forget(['email', 'password','otp']);
            return redirect('/dashboard');
        }
        else{
            return back()->with('error','Wrong email or password');

        }

    }


    /**
     * Destroy an authenticated session.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request)
    {
        Auth::logout();
        return redirect('/login');
    }

    public function getNotifications()
    {
        $notifications = Notification::where('user_id',Auth::id())->get();
        return response()->json($notifications);
    }
}
