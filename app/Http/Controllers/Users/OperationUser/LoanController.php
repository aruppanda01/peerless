<?php

namespace App\Http\Controllers\Users\OperationUser;

use App\Http\Controllers\Controller;
use App\Models\Loan;
use App\Models\LoanRemark;
use App\Models\User;
use App\Notifications\LoanRevertedNotification;
use App\Notifications\LoanUpdatedNotification;
use App\Notifications\NewLoanCreatedNotifiedByOperationDept;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use Barryvdh\DomPDF\Facade as PDF;

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
        return view('users.operation_user.loan.index')->with($data);
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
        return view('users.operation_user.loan.view')->with($data);
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
        $data['loan_remarks'] = LoanRemark::where('loan_id',$id)->latest()->get();
        return view('users.operation_user.loan.edit')->with($data);
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
            'whether_compliance_of_last_sanction_terms_done' => 'required|max:255',
            'deviation_from_last_sanction_terms' => 'required|max:255',
        ],[
            'whether_compliance_of_last_sanction_terms_done.required' => 'This field is required',
            'whether_compliance_of_last_sanction_terms_done.max:255' => 'Maximum character reached',

            'deviation_from_last_sanction_terms.required' => 'This field is required',
            'deviation_from_last_sanction_terms.max:255' => 'Maximum character reached',
        ]);

        $loan = Loan::find($id);
        $loan->whether_compliance_of_last_sanction_terms_done = $request->whether_compliance_of_last_sanction_terms_done;
        $loan->deviation_from_last_sanction_terms = $request->deviation_from_last_sanction_terms;

        $current_user_id = Auth::user()->id;;
        $loan->o_verified_by = $current_user_id;
        $loan->o_verified_status = 1;
        $loan->status = 3;
        $loan->save();

         /**
         * Send notification to the Account Department
         * to inform that operation department just submitted a form
         */
        $operation_dept_users = User::where('role_id',4)->get();
        foreach ($operation_dept_users as $key => $user) {
            Notification::route('mail', $user->email)->notify(new NewLoanCreatedNotifiedByOperationDept($user,$loan));
            createNotification($current_user_id, $user->id , $loan->form_no,'operation_dept_submit_a_form');
        }

        return redirect()->route('operation_user.loan.index')->with('success','Successfully updated');
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
        $loan_details->revert_department = 2;

        $loan_details->o_verified_by = $current_user_id;
        $loan_details->o_verified_status = 0;
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
         * to inform that credit department just submitted a form
         */
        $operation_dept_users = User::where('role_id',2)->get();
        foreach ($operation_dept_users as $key => $user) {
            Notification::route('mail', $user->email)->notify(new LoanRevertedNotification($user,$loan_details));
            createNotification($current_user_id, $user->id ,$loan_details->form_no, 'revert_back_by_operation_dept');
        }

        return redirect()->route('operation_user.loan.index')->with('success','Loan reverted to credit team');
    }

    /**
     * All loans that are found any issue by the Accountant Team
     */
    public function failedLoanDetails(Request $request)
    {
        $data = array();
        $data['all_failed_loan'] = Loan::where('revert_user_id','!=',null)
                            ->where('status',2)
                            ->where('revert_department',Auth::user()->role_id)
                            ->latest()
                            ->get();
        return view('users.operation_user.loan.revert_loan.index')->with($data);
    }

    public function failedLoanDetailsShow($id)
    {
        $data = array();
        $data['loan_details'] = Loan::find($id);
        $data['loan_remarks'] = LoanRemark::where('loan_id',$id)->latest()->get();
        return view('users.operation_user.loan.revert_loan.show')->with($data);
    }
    public function failedLoanDetailsEdit($id)
    {
        $data = array();
        $data['loan_details'] = Loan::find($id);
        $data['loan_remarks'] = LoanRemark::where('loan_id',$id)->latest()->get();
        return view('users.operation_user.loan.revert_loan.edit')->with($data);
    }

    public function failedLoanDetailsUpdate(Request $request, $id)
    {
        $this->validate($request,[
            'whether_compliance_of_last_sanction_terms_done' => 'required|max:255',
            'deviation_from_last_sanction_terms' => 'required|max:255',
        ],[
            'whether_compliance_of_last_sanction_terms_done.required' => 'This field is required',
            'whether_compliance_of_last_sanction_terms_done.max:255' => 'Maximum character reached',

            'deviation_from_last_sanction_terms.required' => 'This field is required',
            'deviation_from_last_sanction_terms.max:255' => 'Maximum character reached',
        ]);

        $loan = Loan::find($id);
        $loan->whether_compliance_of_last_sanction_terms_done = $request->whether_compliance_of_last_sanction_terms_done;
        $loan->deviation_from_last_sanction_terms = $request->deviation_from_last_sanction_terms;

        $loan->is_modify_details_by_operation_dept = 1;

        $loan->status = 4;
        $loan->o_verified_by = Auth::user()->id;
        $loan->o_verified_status = 1;
        $loan->save();


        /**
         * Get the latest revert back remark
         */

        $latest_remarks = LoanRemark::where('loan_id',$loan->id)->latest()->first();
        $latest_remarks->is_solved = 1;
        $latest_remarks->save();

        /**
         * Send notification to the Account Department
         * to inform that operation department just submitted a form
         */
        $operation_dept_users = User::where('role_id',4)->get();
        foreach ($operation_dept_users as $key => $user) {
            Notification::route('mail', $user->email)->notify(new LoanUpdatedNotification($user,$loan));
            createNotification(Auth::user()->id, $user->id , $loan->form_no,'operation_user_form_re_submission');
        }

        return redirect()->route('operation_user.failedLoanDetails')->with('success','Successfully Loan Details updated');
    }

        /**
     * Generate PDF for successfully loan update.
     */
    public function generatePDF(Request $request,$id)
    {
        $data = array();
        $data['loan_details'] = Loan::find($id);

        $pdf = PDF::loadView('users.accountant_user.loan.pdf.report', $data);

        return $pdf->download($data['loan_details']->form_no.'.pdf');
    }
}
