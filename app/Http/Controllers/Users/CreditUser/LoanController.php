<?php

namespace App\Http\Controllers\Users\CreditUser;

use App\Http\Controllers\Controller;
use App\Models\Loan;
use App\Models\User;
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
        return view('users.credit_user.loan.index');
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
        $this->validate($request,[
            'borrower_name' => 'required|max:255',
            'bco_borrower_name' => 'required|max:255',
            'bguarantor_name' => 'required|max:255',
            'loan_type' => 'required|max:255',
            'amount_of_sanction' => 'required|max:255',
            'tenure' => 'required|max:255',
        ],[
            'borrower_name.required' => 'This field is required',
            'borrower_name.max:255' => 'Maximum character reached',

            'bco_borrower_name.required' => 'This field is required',
            'bco_borrower_name.max:255' => 'Maximum character reached',

            'bguarantor_name.required' => 'This field is required',
            'bguarantor_name.max:255' => 'Maximum character reached',

            'loan_type.required' => 'This field is required',
            'loan_type.max:255' => 'Maximum character reached',

            'amount_of_sanction.required' => 'This field is required',
            'amount_of_sanction.max:255' => 'Maximum character reached',

            'tenure.required' => 'This field is required',
            'tenure.max:255' => 'Maximum character reached',
        ]);

        $current_user_id = Auth::user()->id;

        $loan_forms = Loan::count();
        $num_padded = sprintf("%05d", ($loan_forms + 1));
        $form_no = 'PF'. $num_padded;

        $loan = new Loan();
        $loan->user_id = $current_user_id;
        $loan->form_no = $form_no;
        $loan->borrower_name = $request->borrower_name;
        $loan->bco_borrower_name = $request->bco_borrower_name;
        $loan->bguarantor_name = $request->bguarantor_name;
        $loan->loan_type = $request->loan_type;
        $loan->amount_of_sanction = $request->amount_of_sanction;
        $loan->tenure = $request->tenure;
        $loan->status = 1;

        $loan->c_verified_by = $current_user_id;
        $loan->c_verified_status = 1;
        $loan->save();

        /**
         * Send notification to the Operation Department
         * to inform that credit department just submitted a form
         */
        $operation_dept_users = User::where('role_id',3)->get();
        foreach ($operation_dept_users as $key => $user) {
            createNotification($current_user_id, $user->id , 'credit_user_form_submission');
        }

        return redirect()->back()->with('success','Loan Form Submitted Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

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
     * All loans that are found any issue by the Operation Team
     */
    public function failedLoanDetails(Request $request)
    {
        $data = array();
        $data['all_failed_loan'] = Loan::where('revert_user_id','!=',null)
                            ->where('status',2)
                            ->where('revert_department',Auth::user()->role_id)
                            ->latest()
                            ->get();
        return view('users.credit_user.loan.revert_loan.index')->with($data);
    }

    public function failedLoanDetailsShow($id)
    {
        $data = array();
        $data['loan_details'] = Loan::find($id);
        return view('users.credit_user.loan.revert_loan.show')->with($data);
    }
    public function failedLoanDetailsEdit($id)
    {
        $data = array();
        $data['loan_details'] = Loan::find($id);
        return view('users.credit_user.loan.revert_loan.edit')->with($data);
    }

    public function failedLoanDetailsUpdate(Request $request, $id)
    {
        $this->validate($request,[
            'borrower_name' => 'required|max:255',
            'bco_borrower_name' => 'required|max:255',
            'bguarantor_name' => 'required|max:255',
            'loan_type' => 'required|max:255',
            'amount_of_sanction' => 'required|max:255',
            'tenure' => 'required|max:255',
        ],[
            'borrower_name.required' => 'This field is required',
            'borrower_name.max:255' => 'Maximum character reached',

            'bco_borrower_name.required' => 'This field is required',
            'bco_borrower_name.max:255' => 'Maximum character reached',

            'bguarantor_name.required' => 'This field is required',
            'bguarantor_name.max:255' => 'Maximum character reached',

            'loan_type.required' => 'This field is required',
            'loan_type.max:255' => 'Maximum character reached',

            'amount_of_sanction.required' => 'This field is required',
            'amount_of_sanction.max:255' => 'Maximum character reached',

            'tenure.required' => 'This field is required',
            'tenure.max:255' => 'Maximum character reached',
        ]);

        $loan = Loan::find($id);
        $loan->borrower_name = $request->borrower_name;
        $loan->bco_borrower_name = $request->bco_borrower_name;
        $loan->bguarantor_name = $request->bguarantor_name;
        $loan->loan_type = $request->loan_type;
        $loan->amount_of_sanction = $request->amount_of_sanction;
        $loan->tenure = $request->tenure;
        $loan->is_modify_details_by_credit_dept = 1;

        $current_user_id = Auth::user()->id;
        $loan->status = 4;
        $loan->c_verified_by = $current_user_id;
        $loan->c_verified_status = 1;
        $loan->save();

        /**
         * Send notification to the Operation Department
         * to inform that credit department review and re submitted the form
         */
        $operation_dept_users = User::where('role_id',3)->get();
        foreach ($operation_dept_users as $key => $user) {
            createNotification($current_user_id, $user->id , 'credit_user_form_re_submission');
        }

        return redirect()->route('credit_user.failedLoanDetails')->with('success','Successfully Loan Details updated');
    }

}
