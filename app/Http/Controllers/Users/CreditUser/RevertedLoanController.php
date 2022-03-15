<?php

namespace App\Http\Controllers\Users\CreditUser;

use App\Http\Controllers\Controller;
use App\Models\Loan;
use App\Models\LoanComment;
use App\Models\LoanDetails;
use App\Models\LoanRemark;
use App\Models\User;
use App\Notifications\LoanUpdatedNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;

class RevertedLoanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = array();
        $data['all_failed_loan'] = Loan::where('revert_user_id','!=',null)
                            ->where('status',2)
                            ->where('revert_department',Auth::user()->role_id)
                            ->latest()
                            ->get();
        $data['remarks'] = LoanRemark::latest()->get();
        return view('users.credit_user.loan.revert_loan.index')->with($data);
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
        $data['loan_remarks'] = LoanRemark::where('loan_id',$id)->latest()->get();
        return view('users.credit_user.loan.revert_loan.show')->with($data);
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
        $data['other_loan_details'] = LoanDetails::where('loan_id',$id)->get();
        $data['loan_remarks'] = LoanRemark::where('loan_id',$id)->latest()->get();
        $data['loan_comments'] = LoanComment::where('loan_id',$id)->latest()->get();
        return view('users.credit_user.loan.revert_loan.edit')->with($data);
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
            'account_no' => 'nullable|max:255',
            'borrower_name' => 'required|max:255',
            'bco_borrower_name' => 'required|max:255',
            'bguarantor_name' => 'required|max:255',
            // 'loan_type' => 'required|max:255',
            // 'amount_of_sanction' => 'required|max:255',
            // 'tenure' => 'required|max:255',
            'comment' => 'nullable|max:255'
        ],[
            'borrower_name.required' => 'This field is required',
            'borrower_name.max' => 'Maximum character reached.Only 255 character allowed',
            
            'account_no.max' => 'Maximum character reached.Only 255 character allowed',
            'comment.max' => 'Maximum character reached.Only 255 character allowed',

            'bco_borrower_name.required' => 'This field is required',
            'bco_borrower_name.max' => 'Maximum character reached.Only 255 character allowed',

            'bguarantor_name.required' => 'This field is required',
            'bguarantor_name.max' => 'Maximum character reached.Only 255 character allowed',

            // 'loan_type.required' => 'This field is required',
            // 'loan_type.max' => 'Maximum character reached.Only 255 character allowed',

            // 'amount_of_sanction.required' => 'This field is required',
            // 'amount_of_sanction.max' => 'Maximum character reached.Only 255 character allowed',

            // 'tenure.required' => 'This field is required',
            // 'tenure.max' => 'Maximum character reached.Only 255 character allowed',
        ]);

        $loan = Loan::find($id);
        $loan->account_no = $request->account_no;
        $loan->borrower_name = $request->borrower_name;
        $loan->bco_borrower_name = $request->bco_borrower_name;
        $loan->bguarantor_name = $request->bguarantor_name;
        $loan->is_modify_details_by_credit_dept = 1;

        $current_user_id = Auth::user()->id;
        $loan->status = 1;
        $loan->c_verified_by = $current_user_id;
        $loan->c_verified_status = 1;
        $loan->save();

        /**
         * Store loan details 
         */
        $loan_id = $loan->id;
        foreach ($request->addMoreInputFields as $key => $input_field) {
            $loan_details = LoanDetails::find($input_field['loan_details_id']);
            $loan_details->loan_type = $input_field['loan_type'];
            $loan_details->amount_of_sanction = $input_field['amount_of_sanction'];
            $loan_details->tenure = $input_field['tenure'];
            $loan_details->save();
        }

        /**
         * If credit user give any comment then update that comment 
         */

        if ($request->comment != '') {
            $new_comment = LoanComment::where('loan_id',$loan->id)->where('user_id',$current_user_id)->first();
            $new_comment->comment = $request->comment;
            $new_comment->save();
        }

        /**
         * Get the latest revert back remark
         */

         $latest_remarks = LoanRemark::where('loan_id',$loan->id)->latest()->first();
         $latest_remarks->is_solved = 1;
         $latest_remarks->save();

        /**
         * Send notification to the Operation Department
         * to inform that credit department review and re submitted the form
         */
        $operation_dept_users = User::where('role_id',3)->get();
        foreach ($operation_dept_users as $key => $user) {
            Notification::route('mail', $user->email)->notify(new LoanUpdatedNotification($user,$loan));
            createNotification($current_user_id, $user->id , $loan->form_no,'credit_user_form_re_submission');
        }

        return redirect()->route('credit_user.reverted-loan.index')->with('success','Successfully Loan Details updated');
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
}
