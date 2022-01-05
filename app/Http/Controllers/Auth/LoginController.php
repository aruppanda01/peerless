<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

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
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
        public function login(Request $req)
    {
        $req->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);
        $inactive_user = User::where('email', $req->email)->where('status', 0)->where('is_rejected', 0)->first();
        $deactivate_user = User::where('email',$req->email)->where('status',1)->where('is_deactivated',1)->first();
        $user = User::where('email', $req->email)->first();
        if ($user) {
            if ($user->role_id == 2) {
                if ($inactive_user) {
                    auth()->logout();
                    return back()->with('error', 'Your account is not active.')->withInput();
                }
                if ($deactivate_user) {
                    auth()->logout();
                    return back()->with('error', 'Your account is deactivated by admin.')->withInput();
                }
                if (Hash::check($req->password, $user->password)) {
                    Auth::login($user);
                    return redirect()->intended('/home');
                } else {
                    $errors['password'] = 'You have entered wrong password';
                }
            } else {
                $errors['email'] = 'This email is not register with us';
            }
        } else {
            $errors['email'] = 'This email is not register with us';
        }
        return back()->withErrors($errors)->withInput($req->all());
    }
    public function admin_login(Request $request)
    {
        if ($request->method() == 'GET') {
            return view('admin.auth.login');
        } else if ($request->method() == 'POST') {
            $request->validate([
                'email' => 'required|string|email',
                'password' => 'required|string',
            ]);
            $inactive_user = User::where('email', $request->email)->where('status', 0)->first();
            $deactivate_user = User::where('email',$request->email)->where('status',1)->where('is_deactivated',1)->first();
            $user = User::where('email', $request->email)->first();
            if ($user) {
                if ($user->role_id == 1) {
                    if ($inactive_user) {
                        auth()->logout();
                        return back()->with('error', 'Your account is not active.');
                    }
                    if ($deactivate_user) {
                        auth()->logout();
                        return back()->with('error', 'Your account is deactivated by admin.')->withInput();
                    }
                    if (Hash::check($request->password, $user->password)) {
                        Auth::login($user);
                        return redirect()->intended('/home');
                    } else {
                        $errors['password'] = 'You have entered wrong password';
                    }
                } else {
                    $errors['email'] = 'This email is not register with us';
                }
            } else {
                $errors['email'] = 'This email is not register with us';
            }
            return back()->withErrors($errors)->withInput($request->all());
        }
    }
}
