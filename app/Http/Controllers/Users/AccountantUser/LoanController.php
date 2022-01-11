<?php

namespace App\Http\Controllers\Users\AccountantUser;

use App\Http\Controllers\Controller;
use App\Models\Loan;
use App\Models\User;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['all_loan_details'] = Loan::latest()->get();
        return view('users.accountant_user.loan.index')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        $data['loan_details'] = Loan::find($id);
        return view('users.accountant_user.loan.view')->with($data);
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
        $data['loan_details'] = Loan::find($id);
        return view('users.accountant_user.loan.edit')->with($data);
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
        $this->validate($request,[
            'amount_O_s_as_on' => 'required|max:255',
            'residual_tenure' => 'required|max:255',
            'utilization_of_limit' => 'required|max:255',
            'no_of_times_bounces_in_the_account' => 'required|max:255',
            'any_bounces_in_last_six_months' => 'required|max:255',
            'no_of_times_and_days' => 'required|max:255',
            'reasons_for_the_irregularity' => 'required|max:255',
            'peak_irregularity_in_the_account' => 'required|max:255',
            'comment_on_irregularity' => 'required|max:255',
        ],[
            'amount_O_s_as_on.required' => 'This field is required',
            'amount_O_s_as_on.max:255' => 'Maximum character reached',

            'residual_tenure.required' => 'This field is required',
            'residual_tenure.max:255' => 'Maximum character reached',

            'utilization_of_limit.required' => 'This field is required',
            'utilization_of_limit.max:255' => 'Maximum character reached',

            'no_of_times_bounces_in_the_account.required' => 'This field is required',
            'no_of_times_bounces_in_the_account.max:255' => 'Maximum character reached',

            'any_bounces_in_last_six_months.required' => 'This field is required',
            'any_bounces_in_last_six_months.max:255' => 'Maximum character reached',

            'no_of_times_and_days.required' => 'This field is required',
            'no_of_times_and_days.max:255' => 'Maximum character reached',

            'reasons_for_the_irregularity.required' => 'This field is required',
            'reasons_for_the_irregularity.max:255' => 'Maximum character reached',

            'peak_irregularity_in_the_account.required' => 'This field is required',
            'peak_irregularity_in_the_account.max:255' => 'Maximum character reached',

            'comment_on_irregularity.required' => 'This field is required',
            'comment_on_irregularity.max:255' => 'Maximum character reached',

        ]);

        $loan = Loan::find($id);
        $loan->comment_on_irregularity = $request->comment_on_irregularity;
        $loan->peak_irregularity_in_the_account = $request->peak_irregularity_in_the_account;
        $loan->reasons_for_the_irregularity = $request->reasons_for_the_irregularity;
        $loan->no_of_times_and_days = $request->no_of_times_and_days;
        $loan->any_bounces_in_last_six_months = $request->any_bounces_in_last_six_months;
        $loan->no_of_times_bounces_in_the_account = $request->no_of_times_bounces_in_the_account;
        $loan->utilization_of_limit = $request->utilization_of_limit;
        $loan->amount_O_s_as_on = $request->amount_O_s_as_on;
        $loan->residual_tenure = $request->residual_tenure;

        $loan->a_verified_by = Auth::user()->id;
        $loan->a_verified_status = 1;
        $loan->status = 5;
        $loan->save();

         /**
         * Send notification to the Operation Department
         * to inform that account department revert back a form
         */
        $operation_dept_users = User::where('role_id',1)->get();
        foreach ($operation_dept_users as $key => $user) {
            createNotification(Auth::user()->id, $user->id , 'loan_created_by_accountant');
        }

        return redirect()->route('accountant_user.loan.index')->with('success','Successfully updated');
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

    /**
     * If operation dept found any error then they always can revert it back to the credit department .
     */
    public function revertBack(Request $request)
    {
        // dd($request->all());
        $current_user_id = Auth::user()->id;
        $loan_details = Loan::find($request->loan_id);
        $loan_details->revert_user_id = $current_user_id;
        $loan_details->revert_department = 3;

        $loan_details->a_verified_by = Auth::user()->id;
        $loan_details->a_verified_status = 0;
        $loan_details->status = 2;

        $loan_details->save();

         /**
         * Send notification to the Operation Department
         * to inform that account department revert back a form
         */
        $operation_dept_users = User::where('role_id',3)->get();
        foreach ($operation_dept_users as $key => $user) {
            createNotification($current_user_id, $user->id , 'revert_back_by_account_dept');
        }

        return response()->json('success');
    }

    /**
     * Generate PDF for successfully loan update.
     */
    public function generatePDF(Request $request,$id)
    {
        $data = array();
        $data['loan_details'] = Loan::find($id);

        $pdf = PDF::loadView('users.accountant_user.loan.pdf.report', $data);

        return $pdf->download('loan_details.pdf');
    }
}
