@extends('users.layouts.master')
@section('content')
<!--CSS-->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
@include('users.layouts.loan_page_extra_css')

<div class="app-main__outer">
    <div class="container mt-2 mb-5">
        <div class="row m-2 pb-4 mt-2">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a
                            href="{{ route('accountant_user.loan.index') }}">Loan List</a></li>
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
                <form action="{{ route('accountant_user.loan.update', $loan_details->id) }}"
                    method="POST" id="loan_form">
                    @method('PUT')
                    @csrf
                    <div class="form-group">
                        <label for="exampleFormControlFile1">Account No</label>
                        <input class="form-control" type="text" name="account_no"
                            value="{{ $loan_details->account_no ?  $loan_details->account_no : ''}}" disabled>
                        @error('account_no')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlFile1">1. Borrower’s Name</label>
                        <input class="form-control" type="text" name="borrower_name"
                            value="{{ $loan_details->borrower_name ?? old('borrower_name') }}"
                            disabled>
                        @error('borrower_name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlFile1">2. Co-Borrower’s Name, if any</label>
                        <input class="form-control" type="text" name="bco_borrower_name"
                            value="{{ $loan_details->bco_borrower_name ?? old('bco_borrower_name') }}"
                            disabled>
                        @error('bco_borrower_name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlFile1">3. Guarantor’s Name, if any</label>
                        <input class="form-control" type="text" name="bguarantor_name"
                            value="{{ $loan_details->bguarantor_name ?? old('bguarantor_name') }}"
                            disabled>
                        @error('bguarantor_name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlFile1">4. Type of Loan Available</label>
                        <div class="wh_class actv_bg">
                            @foreach ($other_loan_details as $key => $other_loan_detail)
                            <div class="row" id="loan_type">
                                <div class="col-md-3">
                                    Loan - {{ $key + 1 }}
                                </div>
                                <div class="col-md-9">
                                    <input class="form-control" type="text" name="loan_type"
                                    value="{{ $other_loan_detail->loan_type ?? old('loan_type') }}" disabled>
                                </div>
                            </div>
                            <hr>
                            @endforeach
                        </div>
                        @error('loan_type')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlFile1">5. Amount of Sanction(Rs)</label>
                        <div class="wh_class actv_bg">
                            @foreach ($other_loan_details as $key => $other_loan_detail)
                                <div class="row" id="loan_type">
                                    <div class="col-md-3">
                                        Loan - {{ $key + 1 }}
                                    </div>
                                    <div class="col-md-9">
                                        <input class="form-control" type="text" name="amount_of_sanction"
                                        value="{{ $other_loan_detail->amount_of_sanction ?? old('amount_of_sanction') }}" disabled>
                                        <span class="loan_type_err text-danger"></span>
                                    </div>
                                </div>
                                <hr>
                            @endforeach
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlFile1">6. Tenure</label>
                        <div class="wh_class actv_bg">
                            @foreach ($other_loan_details as $key => $other_loan_detail)
                            <div class="row" id="loan_type">
                                <div class="col-md-3">
                                    Loan - {{ $key + 1 }}
                                </div>
                                <div class="col-md-9">
                                    <input class="form-control" type="text" name="tenure"
                                    value="{{ $other_loan_detail->tenure ?? old('tenure') }}" disabled>
                                </div>
                            </div>
                            <hr>
                            @endforeach
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlFile1">7. Whether compliance of last sanction terms done</label>
                        <div class="wh_class actv_bg">
                            @foreach ($other_loan_details as $key => $other_loan_detail)
                            <div class="row" id="loan_type">
                                <div class="col-md-3">
                                    Loan - {{ $key + 1 }}
                                </div>
                                <div class="col-md-9">
                                    <input class="form-control" type="text" name="whether_compliance_of_last_sanction_terms_done"
                                    value="{{ $other_loan_detail->whether_compliance_of_last_sanction_terms_done ?? old('whether_compliance_of_last_sanction_terms_done') }}"
                                    id="whether_compliance_of_last_sanction_terms_done" disabled>
                                </div>
                            </div>
                        <hr>
                        @endforeach
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlFile1">8. Deviation from last sanction terms, if any</label>
                        <div class="wh_class actv_bg">
                            @foreach ($other_loan_details as $key => $other_loan_detail)
                            <div class="row">
                                <div class="col-md-3">
                                    Loan - {{ $key + 1 }}
                                </div>
                                <div class="col-md-9">
                                     <input class="form-control" type="text" name="deviation_from_last_sanction_terms"
                                    value="{{ $other_loan_detail->deviation_from_last_sanction_terms ?? old('deviation_from_last_sanction_terms') }}"
                                    id="deviation_from_last_sanction_terms" disabled>
                                </div>
                            </div>
                        <hr>
                        @endforeach
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlFile1">9. Amount O/s as on<span class="text-danger">*</span></label>
                        <div class="wh_class actv_bg">
                            @foreach ($other_loan_details as $key => $other_loan_detail)
                            <div class="row">
                                <div class="col-md-3">
                                    Loan - {{ $key + 1 }}
                                </div>
                                <div class="col-md-9">
                                    <input class="form-control" type="text" name="addMoreInputFields[{{ $key }}][amount_O_s_as_on]" onkeydown="return numericOnly(event);" onkeyup="indianMoneyFormat(event)">
                                    <input type="hidden" name="addMoreInputFields[{{ $key }}][loan_details_id]" value="{{ $other_loan_detail->id }}">
                                </div>
                            </div>
                            <hr>
                        @endforeach
                        </div>
                        @error('amount_O_s_as_on')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlFile1">10. Residual Tenure<span class="text-danger">*</span></label>
                        <div class="wh_class actv_bg">
                            @foreach ($other_loan_details as $key => $other_loan_detail)
                            <div class="row">
                                <div class="col-md-3">
                                    Loan - {{ $key + 1 }}
                                </div>
                                <div class="col-md-9">
                                    <input class="form-control" type="text" name="addMoreInputFields[{{ $key }}][residual_tenure]">
                                    <input type="hidden" name="addMoreInputFields[{{ $key }}][loan_details_id]" value="{{ $other_loan_detail->id }}">
                                </div>
                            </div>
                            <hr>
                         @endforeach
                        </div>
                        @error('residual_tenure')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                       
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlFile1">11. Utilization of Limit<span class="text-danger">*</span></label>
                        <div class="wh_class actv_bg">
                            @foreach ($other_loan_details as $key => $other_loan_detail)
                            <div class="row">
                                <div class="col-md-3">
                                    Loan - {{ $key + 1 }}
                                </div>
                                <div class="col-md-9">
                                    <input class="form-control" type="text" name="addMoreInputFields[{{ $key }}][utilization_of_limit]">
                                    <input type="hidden" name="addMoreInputFields[{{ $key }}][loan_details_id]" value="{{ $other_loan_detail->id }}">
                                </div>
                                </div>
                            <hr>
                            @endforeach
                        </div>
                        @error('utilization_of_limit')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                        
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlFile1" class="text-dark">12. Occurrence of irregularity in the
                            account since Operational </label>
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlFile1">a. No. of times Bounces in the account<span class="text-danger">*</span></label>
                        <div class="wh_class actv_bg">
                            @foreach ($other_loan_details as $key => $other_loan_detail)
                            <div class="row">
                                <div class="col-md-3">
                                    Loan - {{ $key + 1 }}
                                </div>
                                <div class="col-md-9">
                                    <input class="form-control" type="text" name="addMoreInputFields[{{ $key }}][no_of_times_bounces_in_the_account]">
                                    <input type="hidden" name="addMoreInputFields[{{ $key }}][loan_details_id]" value="{{ $other_loan_detail->id }}">
                                </div>
                            </div>
                            @endforeach
                            @error('no_of_times_bounces_in_the_account')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlFile1">b. Any bounces in last six months<span class="text-danger">*</span></label>
                        <div class="wh_class actv_bg">
                            @foreach ($other_loan_details as $key => $other_loan_detail)
                            <div class="row">
                                <div class="col-md-3">
                                    Loan - {{ $key + 1 }}
                                </div>
                                <div class="col-md-9">
                                    <input class="form-control" type="text" name="addMoreInputFields[{{ $key }}][any_bounces_in_last_six_months]">
                                    <input type="hidden" name="addMoreInputFields[{{ $key }}][loan_details_id]" value="{{ $other_loan_detail->id }}">
                                </div>
                            </div>
                            @endforeach
                        </div>
                        @error('any_bounces_in_last_six_months')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlFile1">c. No. of times and days, the account was irregular<span class="text-danger">*</span></label>
                        <div class="wh_class actv_bg">
                            @foreach ($other_loan_details as $key => $other_loan_detail)
                            <div class="row">
                                <div class="col-md-3">
                                    Loan - {{ $key + 1 }}
                                </div>
                                <div class="col-md-9">
                                    <input class="form-control" type="text" name="addMoreInputFields[{{ $key }}][no_of_times_and_days]">
                                    <input type="hidden" name="addMoreInputFields[{{ $key }}][loan_details_id]" value="{{ $other_loan_detail->id }}">
                                </div>
                            </div>
                            @endforeach
                            </div>
                            @error('no_of_times_and_days')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlFile1">d. Reasons for the irregularity (ies)<span class="text-danger">*</span></label>
                        <div class="wh_class actv_bg">
                            @foreach ($other_loan_details as $key => $other_loan_detail)
                                <div class="row">
                                    <div class="col-md-3">
                                        Loan - {{ $key + 1 }}
                                    </div>
                                    <div class="col-md-9">
                                        <input class="form-control" type="text" name="addMoreInputFields[{{ $key }}][reasons_for_the_irregularity]">
                                        <input type="hidden" name="addMoreInputFields[{{ $key }}][loan_details_id]" value="{{ $other_loan_detail->id }}">
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        @error('reasons_for_the_irregularity')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlFile1">e. Peak irregularity in the account, if any<span class="text-danger">*</span></label>
                        <div class="wh_class actv_bg">
                            @foreach ($other_loan_details as $key => $other_loan_detail)
                                <div class="row">
                                    <div class="col-md-3">
                                        Loan - {{ $key + 1 }}
                                    </div>
                                    <div class="col-md-9">
                                        <input class="form-control" type="text" name="addMoreInputFields[{{ $key }}][peak_irregularity_in_the_account]">
                                        <input type="hidden" name="addMoreInputFields[{{ $key }}][loan_details_id]" value="{{ $other_loan_detail->id }}">
                                    </div>
                                </div>
                            @endforeach
                        </div>
                            @error('peak_irregularity_in_the_account')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlFile1">f. Comment on irregularity, if any<span class="text-danger">*</span></label>
                        <div class="wh_class actv_bg">
                            @foreach ($other_loan_details as $key => $other_loan_detail)
                            <div class="row">
                                <div class="col-md-3">
                                    Loan - {{ $key + 1 }}
                                </div>
                                <div class="col-md-9">
                                    <input class="form-control" type="text" name="addMoreInputFields[{{ $key }}][comment_on_irregularity]">
                                    <input type="hidden" name="addMoreInputFields[{{ $key }}][loan_details_id]" value="{{ $other_loan_detail->id }}">
                                </div>
                            </div>
                            @endforeach
                        </div>
                        @error('comment_on_irregularity')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                        
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlFile1">Comment on Conduct of the A/c:<span class="text-danger">*</span></label>
                        <input class="form-control" type="text" name="comment_on_conduct">
                        @error('comment_on_conduct')
                        <span class="text-danger">{{ $message }}</span>
                         @enderror
                    </div>
                    {{-- <hr>
                    <div class="form-group">
                        <label for="exampleFormControlFile1">Comment</label>
                        <input class="form-control" type="text" name="comment">
                        @error('comment')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div> --}}
                    <hr>
                    <div class="form-group">
                        <label for="exampleFormControlFile1"><b><u>Available Comments</u></b></label>
                        @if ($loan_comments->count() > 0)
                            <ul>
                                @foreach ($loan_comments as $loan)
                                        <li>{{ $loan->comment }}
                                            (By <b>{{  getUserDepartment($loan->user_id) }}s  </b> at <span>{{ date('d-M-y', strtotime($loan->created_at)) }},
                                                {{ getAsiaTime($loan->created_at) }}</span>)
                                        </li>
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
                    <hr>
                    <div class="form-group">
                        <label for="exampleFormControlFile1"><b><u>Remarks</u></b></label>
                        @if ($loan_remarks->count() > 0)
                            <ul>
                                @foreach ($loan_remarks as $loan)
                                    @if ($loan->is_solved == 1)
                                        <li>
                                            <del>{{ $loan->remarks }}  (<span>{{ date('d-M-y',strtotime($loan->created_at)) }}, {{ getAsiaTime($loan->created_at) }}</span>)</del>
                                        </li>
                                    @else
                                     <li>{{ $loan->remarks }}  <span>{{ date('d-M-y',strtotime($loan->created_at)) }}, {{ getAsiaTime($loan->created_at) }}</span></li>
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
                        {{-- <button class="btn btn-primary float-left" data-toggle="tooltip" data-placement="top"
                            title="Revert Back to the Operation Deperment"
                            onclick="revertBack({{ $loan_details->id }})">Revert Back to Opertaion Dept</button> --}}
                            <!-- Button trigger modal -->
                        <button type="button" class="btn btn-primary revert-loan float-left" data-toggle="modal" data-target="#exampleModalCenter" data-id="{{ $loan_details->id }}">
                            Revert Back to Credit Dept 
                        </button>
                        <button type="button" class="btn btn-primary revert-loan float-left ml-2" data-toggle="modal" data-target="#exampleModalCenterForOperation" data-id="{{ $loan_details->id }}">
                            Revert Back to Operation Dept 
                        </button>
                        <button class="btn btn-primary" id="btn_submit">Submit</button>
                    </div>
                </form>
            </div>
        </div>
        </div>
    @include('users.layouts.static_footer')
</div>
</div>
</div>
@include('users.accountant_user.loan.modal.revert_to_credit')
@include('users.accountant_user.loan.modal.revert_to_operation')
@include('users.accountant_user.loan.modal.revert_js')
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

        // Add commas
        function indianMoneyFormat(event) {
        var input = event.target.value.replaceAll(',', '');
        console.log(input);
        if (input.length < 1)
            $(this).val('');
        else {
            var val = parseFloat(input);
            var formatted = inrFormat(input);
            if (formatted.indexOf('.') > 0) {
                var split = formatted.split('.');
                formatted = split[0] + '.' + split[1].substring(0, 2);
            }
            event.target.value = formatted;
        }
    }
        $('#amount_O_s_as_on').on('keyup', function() {
            var input = $(this).val().replaceAll(',', '');
            if (input.length < 1)
                $(this).val('');
            else {
                var val = parseFloat(input);
                var formatted = inrFormat(input);
                if (formatted.indexOf('.') > 0) {
                    var split = formatted.split('.');
                    formatted = split[0] + '.' + split[1].substring(0, 2);
                }
                $(this).val(formatted);
            }

        });

        function inrFormat(val) {
            var x = val;
            x = x.toString();
            var afterPoint = '';
            if (x.indexOf('.') > 0)
                afterPoint = x.substring(x.indexOf('.'), x.length);
            x = Math.floor(x);
            x = x.toString();
            var lastThree = x.substring(x.length - 3);
            var otherNumbers = x.substring(0, x.length - 3);
            if (otherNumbers != '')
                lastThree = ',' + lastThree;
            var res = otherNumbers.replace(/\B(?=(\d{2})+(?!\d))/g, ",") + lastThree + afterPoint;
            return res;
        }

        function numericOnly(event) {
            var key = event.keyCode;
            console.log(key);
            return ((key >= 48 && key <= 57) || (key >= 96 && key <= 105) || key == 57 || key == 9 || key == 46 || key == 8  || key == 110);
        };

</script>
@endsection
