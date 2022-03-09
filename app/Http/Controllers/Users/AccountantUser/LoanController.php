<?php

namespace App\Http\Controllers\Users\AccountantUser;

use App\Http\Controllers\Controller;
use App\Models\Loan;
use App\Models\LoanComment;
use App\Models\LoanDetails;
use App\Models\LoanRemark;
use App\Models\User;
use App\Notifications\LoanRevertedNotification;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;

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
        $data['other_loan_details'] = LoanDetails::where('loan_id',$id)->get();
        $data['loan_remarks'] = LoanRemark::where('loan_id',$id)->latest()->get();
        $data['loan_comments'] = LoanComment::where('loan_id',$id)->latest()->get();
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
        $data['loan_details'] = Loan::where('status','>=',3)->find($id);
        $data['other_loan_details'] = LoanDetails::where('loan_id',$id)->get();
        $data['loan_remarks'] = LoanRemark::where('loan_id',$id)->latest()->get();
        $data['loan_comments'] = LoanComment::where('loan_id',$id)->latest()->get();
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
        // dd($request->all());
        $this->validate($request,[
            // 'amount_O_s_as_on' => 'required|max:255',
            // 'residual_tenure' => 'required|max:255',
            // 'utilization_of_limit' => 'required|max:255',
            // 'no_of_times_bounces_in_the_account' => 'required|max:255',
            // 'any_bounces_in_last_six_months' => 'required|max:255',
            // 'no_of_times_and_days' => 'required|max:255',
            // 'reasons_for_the_irregularity' => 'required|max:255',
            // 'peak_irregularity_in_the_account' => 'required|max:255',
            // 'comment_on_irregularity' => 'required|max:255',
            'comment_on_conduct' => 'required|max:255',
            'comment' => 'nullable|max:255'
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

            'comment_on_conduct.required' => 'This field is required',
            'comment_on_conduct.max:255' => 'Maximum character reached',

            'comment' => 'nullable|max:255'

        ]);

        $loan = Loan::find($id);

        $loan->a_verified_by = Auth::user()->id;
        $loan->a_verified_status = 1;
        $loan->status = 5;
        $loan->save();

        /**
         * Store loan details
         */
        foreach ($request->addMoreInputFields as $key => $input_field) {
            $loan_details = LoanDetails::find($input_field['loan_details_id']);
            $loan_details->comment_on_irregularity = $input_field['comment_on_irregularity'];
            $loan_details->peak_irregularity_in_the_account = $input_field['peak_irregularity_in_the_account'];
            $loan_details->reasons_for_the_irregularity = $input_field['reasons_for_the_irregularity'];
            $loan_details->no_of_times_and_days = $input_field['no_of_times_and_days'];
            $loan_details->any_bounces_in_last_six_months = $input_field['any_bounces_in_last_six_months'];
            $loan_details->no_of_times_bounces_in_the_account = $input_field['no_of_times_bounces_in_the_account'];
            $loan_details->utilization_of_limit = $input_field['utilization_of_limit'];
            $loan_details->amount_O_s_as_on = $input_field['amount_O_s_as_on'];
            $loan_details->residual_tenure = $input_field['residual_tenure'];
            $loan_details->save();
        }

        /**
         * If operation user give any comment then save that comment 
         */

        if ($request->comment_on_conduct != '') {
            $new_comment = new LoanComment();
            $new_comment->user_id = Auth::user()->id;
            $new_comment->loan_id = $loan->id;
            $new_comment->comment = $request->comment_on_conduct;
            $new_comment->save();
        }

         /**
         * Send notification to the Operation Department
         * to inform that account department revert back a form
         */
        $operation_dept_users = User::where('role_id',1)->get();
        foreach ($operation_dept_users as $key => $user) {
            createNotification(Auth::user()->id, $user->id ,$loan->form_no, 'loan_created_by_accountant');
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
     * If Account dept found any error then they always can revert it back to the operation department .
     */
    public function revertBackToOperation(Request $request)
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
         * Store remarks for why the form is reverted?
         */
        $new_remarks = new LoanRemark();
        $new_remarks->user_id = $current_user_id;
        $new_remarks->loan_id = $request->loan_id;
        $new_remarks->remarks = $request->remarks;
        $new_remarks->save();

         /**
         * Send notification to the Operation Department
         * to inform that account department revert back a form
         */
        $operation_dept_users = User::where('role_id',3)->get();
        foreach ($operation_dept_users as $key => $user) {
            Notification::route('mail', $user->email)->notify(new LoanRevertedNotification($user,$loan_details));
            createNotification($current_user_id, $user->id ,$loan_details->form_no, 'revert_back_by_account_dept');
        }
        

        return redirect()->route('accountant_user.loan.index')->with('success','Loan reverted to operation team');
    }
    /**
     * If Account dept found any error then they always can revert it back to the operation department .
     */
    public function revertBackToCredit(Request $request)
    {
        // dd($request->all());
        $current_user_id = Auth::user()->id;
        $loan_details = Loan::find($request->loan_id);
        $loan_details->revert_user_id = $current_user_id;
        $loan_details->revert_department = 2;

        $loan_details->a_verified_by = Auth::user()->id;
        $loan_details->a_verified_status = 0;
        $loan_details->status = 2;

        $loan_details->save();

        /**
         * Store remarks for why the form is reverted?
         */
            $new_remarks = new LoanRemark();
            $new_remarks->user_id = $current_user_id;
            $new_remarks->loan_id = $request->loan_id;
            $new_remarks->remarks = $request->remarks;
            $new_remarks->save();

         /**
         * Send notification to the Credit Department
         * to inform that account department revert back a form
         */
        $operation_dept_users = User::where('role_id',2)->get();
        foreach ($operation_dept_users as $key => $user) {
            Notification::route('mail', $user->email)->notify(new LoanRevertedNotification($user,$loan_details));
            createNotification($current_user_id, $user->id ,$loan_details->form_no, 'revert_back_by_account_dept');
        }

        return redirect()->route('accountant_user.loan.index')->with('success','Loan reverted to credit team');
    }

    /**
     * Generate PDF for successfully loan update.
     */
    public function generatePDF(Request $request,$id)
    {
        $data = array();
        $data['loan_details'] = Loan::find($id);
        $data['other_loan_details'] = LoanDetails::where('loan_id',$id)->get();
        $data['loan_comments'] = LoanComment::where('loan_id',$id)->get();

        $pdf = PDF::loadView('users.accountant_user.loan.pdf.report', $data);

        return $pdf->download($data['loan_details']->form_no.'.pdf');
    }
}
