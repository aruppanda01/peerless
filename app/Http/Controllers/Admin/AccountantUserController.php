<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Notifications\AccountActivationMail;
use App\Notifications\AccountDeactivateMail;
use App\Notifications\WelcomeMail;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Notification;

class AccountantUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = array();
        $data['users'] = User::where('role_id',4)->latest()->get();
        return view('admin.account_user.index')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.account_user.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'first_name' => 'required |string| max:255',
            'last_name' => 'required |string| max:255',
            'email' => 'required|email | unique:users',
            'phone_no' => 'required| max:10',
            // 'dob' => 'required | date',
            // 'gender' => 'required'
        ]);

        DB::beginTransaction();
        try {
            $accountant_user = User::where('role_id', 4)->count();
            $num_padded = sprintf("%05d", ($accountant_user + 1));
            $id_no = 'PFAU' . $num_padded;

            $user = new User();
            $user->role_id = 4;
            $user->first_name = $request['first_name'];
            $user->last_name = $request['last_name'];
            $user->email = $request['email'];
            $user->phone_no = $request['phone_no'];
            $user->id_no =  $id_no;
            // $user->dob = $request['dob'];
            // $user->gender = $request['gender'];
            $user->password = Hash::make($id_no);
            $user->status = 0;
            $user->save();

            DB::commit();
            return redirect()->route('admin.accountant-user.index')->with('success','User Created Successfully');
        } catch (Exception $e) {
            DB::rollback();
            return 0;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = array();
        $data['user_details'] = User::find($id);
        $data['user_age'] = Carbon::parse($data['user_details']->dob)->diff(Carbon::now())->format('%y years');
        return view('admin.account_user.view')->with($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = array();
        $data['user_details'] = User::find($id);
        return view('admin.account_user.edit')->with($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'first_name' => 'required |string| max:255',
            'last_name' => 'required |string| max:255',
            'phone_no' => 'required| max:10',
            // 'dob' => 'required | date',
            // 'gender' => 'required'
        ]);

        DB::beginTransaction();
        try {

            $user = User::find($id);
            $user->first_name = $request['first_name'];
            $user->last_name = $request['last_name'];
            $user->phone_no = $request['phone_no'];
            // $user->dob = $request['dob'];
            // $user->gender = $request['gender'];
            $user->save();

            DB::commit();
            return redirect()->route('admin.accountant-user.index')->with('success','User Details Updated Successfully');
        } catch (Exception $e) {
            DB::rollback();
            return 0;
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function approval($id)
    {
        $user = User::findOrFail($id);
        if ($user->status == 0) {
            $user->status = 1;
            $user->save();
            Notification::route('mail', $user->email)->notify(new WelcomeMail($user));
            return response()->json(['success' => true, 'data' => 'activated']);
        }
    }

    public function deactivate_account($id)
    {
        $user = User::findOrFail($id);
        if ($user->status == 1) {
            $user->is_deactivated = 1;
            $user->save();
            Notification::route('mail', $user->email)->notify(new AccountDeactivateMail($user));
            return response()->json(['success' => true, 'data' => 'inactivated']);
        }
    }
    public function activate_account($id)
    {
        $user = User::findOrFail($id);
        if ($user->status == 1) {
            $user->is_deactivated = 0;
            $user->save();
            Notification::route('mail', $user->email)->notify(new AccountActivationMail($user));
            return response()->json(['success' => true,'data' => 'inactivated']);
        }
    }
}
