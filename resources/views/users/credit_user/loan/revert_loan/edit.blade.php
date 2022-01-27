@extends('users.layouts.master')
@section('content')
<!--CSS-->
@include('users.layouts.loan_page_extra_css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
<div class="app-main__outer">
    <div class="container mt-2 mb-5">
        <div class="row m-2 pb-4 mt-2">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a
                            href="{{ route('operation_user.loan.index') }}">Loan List</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Review Loan Details</li>
                </ol>
            </nav>
        </div>
        <div class="row m-0 justify-content-center pb-4 mt-2 form_title">
            <div class="d-flex">
                <img src="{{ asset('frontend/loan/peerless_logo.png') }}">
                <h2 class="col-12 p-0">Peerless Financial Services Limited
                    <span>‘Peerless Bhavan’, 3 Esplanade East, Kolkata – 700069</span>
                </h2>
            </div>
            <h6 class="col-12 p-0">Conduct Sheet for Loan Against Salary/ Loan To Professional Loan Products (Top Up)
            </h6>
        </div>
        <div class="row  m-0 justify-content-center form_title">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show col-12 col-lg-7 mb-2" role="alert">
                    {{ session('success') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
        </div>

        <div class="row m-0 justify-content-center ">
            <div class="col-12 col-lg-7 col-lg-7 shadow p-3 bg-light">
                <form
                    action="{{ route('credit_user.reverted-loan.update',$loan_details->id) }}"
                    method="POST" id="loan_form">
                    @method('PUT')
                    @csrf
                    <div class="form-group">
                        <label for="exampleFormControlFile1">1. Borrower’s Name</label>
                        <input class="form-control" type="text" name="borrower_name"
                            value="{{ $loan_details->borrower_name ?? old('borrower_name') }}">
                        @error('borrower_name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlFile1">2. Co-Borrower’s Name, if any</label>
                        <input class="form-control" type="text" name="bco_borrower_name"
                            value="{{ $loan_details->bco_borrower_name ?? old('bco_borrower_name') }}">
                        @error('bco_borrower_name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlFile1">3. Guarantor’s Name, if any</label>
                        <input class="form-control" type="text" name="bguarantor_name"
                            value="{{ $loan_details->bguarantor_name ?? old('bguarantor_name') }}">
                        @error('bguarantor_name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlFile1">4. Type of Loan Available</label>
                        <input class="form-control" type="text" name="loan_type"
                            value="{{ $loan_details->loan_type ?? old('loan_type') }}">
                        @error('loan_type')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlFile1">5. Amount of Sanction (Rs)</label>
                        <input class="form-control" type="text" name="amount_of_sanction"
                            value="{{ $loan_details->amount_of_sanction ?? old('amount_of_sanction') }}">
                        @error('amount_of_sanction')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlFile1">6. Tenure</label>
                        <input class="form-control" type="text" name="tenure"
                            value="{{ $loan_details->tenure ?? old('tenure') }}">
                        @error('tenure')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlFile1">7. Whether compliance of last sanction terms done</label>
                        <input class="form-control" type="text" name="whether_compliance_of_last_sanction_terms_done"
                            value="{{ $loan_details->whether_compliance_of_last_sanction_terms_done ?? old('whether_compliance_of_last_sanction_terms_done') }}"
                            id="whether_compliance_of_last_sanction_terms_done" disabled>
                        <p id="err_msg" class="text-danger"></p>
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlFile1">8. Deviation from last sanction terms, if any</label>
                        <input class="form-control" type="text" name="deviation_from_last_sanction_terms"
                            value="{{ $loan_details->deviation_from_last_sanction_terms ?? old('deviation_from_last_sanction_terms') }}"
                            id="deviation_from_last_sanction_terms" disabled>
                        <p id="err_msg1" class="text-danger"></p>
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlFile1">9. Amount O/s as on</label>
                        <input class="form-control" type="text" name="amount_O_s_as_on" disabled>
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlFile1">10. Residual Tenure</label>
                        <input class="form-control" type="text" name="residual_tenure" disabled>
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlFile1">11. Utilization of Limit</label>
                        <input class="form-control" type="text" name="utilization_of_limit" disabled>
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlFile1" class="text-dark">12. Occurrence of irregularity in the
                            account since Operational </label>
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlFile1">a. No. of times Bounces in the account</label>
                        <input class="form-control" type="text" name="no_of_times_bounces_in_the_account" disabled>
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlFile1">b. Any bounces in last six months</label>
                        <input class="form-control" type="text" name="any_bounces_in_last_six_months" disabled>
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlFile1">c. No. of times and days, the account was irregular</label>
                        <input class="form-control" type="text" name="no_of_times_and_days" disabled>
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlFile1">d. Reasons for the irregularity (ies)</label>
                        <input class="form-control" type="text" name="reasons_for_the_irregularity" disabled>
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlFile1">e. Peak irregularity in the account, if any</label>
                        <input class="form-control" type="text" name="peak_irregularity_in_the_account" disabled>
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlFile1">f. Comment on irregularity, if any</label>
                        <input class="form-control" type="text" name="comment_on_irregularity" disabled>
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlFile1">Comment on Conduct of the A/c:</label>
                        <input class="form-control" type="text" name="comment_on_irregularity" disabled>
                    </div>
                    <hr>
                    <div class="form-group">
                        <label for="exampleFormControlFile1"><b>Remarks</b></label>
                        @if ($loan_remarks->count() > 0)
                            <ul>
                                @foreach ($loan_remarks as $loan)
                                    @if ($loan->is_solved == 1)
                                        <li>
                                            <del>{{ $loan->remarks }}  (<span>{{ date('d-M-y',strtotime($loan->created_at)) }}, {{ getAsiaTime($loan->created_at) }}</span>)</del>
                                        </li>
                                    @else
                                     <li>{{ $loan->remarks }}  (<span>{{ date('d-M-y',strtotime($loan->created_at)) }}, {{ getAsiaTime($loan->created_at) }}</span>)</li>
                                    @endif
                                @endforeach
                            </ul>
                        @else
                            <ul>
                                <li>
                                    N/A
                                </li>
                            </ul>
                        @endif
                    </div>
                    <div class="col-12 text-right mt-3 p-0">
                        <button class="btn btn-primary" id="btn_submit">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @include('users.layouts.static_footer')
</div>
<script>
    $('#btn_submit').on('click', function () {
        event.preventDefault();
        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: 'btn btn-success',
                cancelButton: 'btn btn-danger'
            },
            buttonsStyling: false
        })

        swalWithBootstrapButtons.fire({
            title: 'Are you sure?',
            text: "To submit Loan Form!",
            iconHtml: '<img src="{{ asset('frontend/images/logo.png') }}">',
            showCancelButton: true,
            confirmButtonText: 'Yes',
            cancelButtonText: 'Cancel!',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                event.preventDefault();
                document.getElementById('loan_form').submit();
            } else if (
                result.dismiss === Swal.DismissReason.cancel
            ) {
                swalWithBootstrapButtons.fire(
                    'Cancelled',
                    'Loan Form Is Not Submitted :)',
                    'error'
                )
            }
        })
    })
    setTimeout(function () {
        $(".alert-success").hide();
    }, 5000);

</script>
@endsection
