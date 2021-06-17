<?php

namespace App\Http\Controllers\Backend\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    
    protected $redirectTo = RouteServiceProvider::ADMIN_DASHBOARD;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    /**
     * show login form for admin guard
     *
     * @return void
     */
    


    public function showLoginForm()
    {
        return view('backend.auth.login');
    }


    public function login(Request $request){
        // Validate Login Data
        $request->validate([
            'email' => 'required|max:50|exists:admins,email',
            'password' => 'required|min:4',
        ],
        [
            'email.exists' => 'This email address is not exists.',
        ]);

        // Attempt to login
        if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password], $request->remember)) {
            // Redirect to dashboard
            session()->flash('login_success', 'Successully Logged in !');
            return redirect()->intended(route('admin.dashboard'));
        } else {
            // Search using username 
            if (Auth::guard('admin')->attempt(['username' => $request->email, 'password' => $request->password], $request->remember)) {
                session()->flash('login_success', 'Successully Logged in !');
                return redirect()->intended(route('admin.dashboard'));
            }
            // error
            session()->flash('login_error', 'Invalid email and password');
            return back();
        }


    
    }

    /**
     * Logout admin guard
     */

     public function logout(){
         Auth::guard('admin')->logout();
         return redirect()->route('admin.login');
     }














}
