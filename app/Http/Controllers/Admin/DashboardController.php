<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // dd('hii');
        $data = array();
        return view('admin.dashboard')->with($data);
    }
}
