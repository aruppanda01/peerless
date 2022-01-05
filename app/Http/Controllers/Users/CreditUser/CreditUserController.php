<?php

namespace App\Http\Controllers\Users\CreditUser;

use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CreditUserController extends Controller
{
    public function index()
    {
        $data = array();
        $current_user_id = Auth::user()->id;
        $data['user_details'] = User::where('id', $current_user_id)->first();
        $data['user_age'] = Carbon::parse($data['user_details']->dob)->diff(Carbon::now())->format('%y years');
        return view('users.credit_user.profile')->with($data);
    }
}
