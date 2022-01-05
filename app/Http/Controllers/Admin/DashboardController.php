<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $data = array();
        $data['total_credit_user'] = User::where('role_id',2)->count();
        $data['total_operation_user'] = User::where('role_id',3)->count();
        $data['total_accountant_user'] = User::where('role_id',4)->count();
        return view('admin.dashboard')->with($data);
    }
}
