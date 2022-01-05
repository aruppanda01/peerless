<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $redirectTo = 'admin/dashboard';
        switch (Auth::user()->role_id) {
            case 1:
                $redirectTo = 'admin/dashboard';
                break;
            case 2:
                $redirectTo = 'credit_user/profile';
                break;
            case 3:
                $redirectTo = 'operation_user/profile';
                break;
            case 4:
                $redirectTo = 'accountant_user/profile';
                break;
        }
        return redirect($redirectTo);
        // return view('home');
    }
}
