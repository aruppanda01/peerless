@extends('users.layouts.master')
@section('content')
    @include('users.layouts.loan_page_extra_css')
    <!--CSS-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    {{-- <link href="{{ asset('frontend/loan/css/style.css') }}" rel="stylesheet" type="text/css"> --}}
    {{-- <link href="{{ asset('frontend/loan/css/bootstrap.css') }}" rel="stylesheet" type="text/css"> --}}
    <div class="app-main__outer">
        <div class="container mt-2">
            <div class="row m-0 justify-content-center pb-4 mt-5 form_title">
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
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show col-12 col-lg-7 mb-2" role="alert">
                        {{ session('success') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
            </div>

            <div class="row col-12 m-0 justify-content-center ">
                <div class="col-12 col-lg-7 shadow p-3 bg-light">
                    <form action="{{ route('credit_user.loan.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="exampleFormControlFile1">1. Borrower’s Name</label>
                            <input class="form-control" type="text" name="borrower_name"
                                value="{{ old('borrower_name') }}">
                            @error('borrower_name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlFile1">2. BCo-Borrower’s Name</label>
                            <input class="form-control" type="text" name="bco_borrower_name"
                                value="{{ old('bco_borrower_name') }}">
                            @error('bco_borrower_name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlFile1">3. BGuarantor’s Name</label>
                            <input class="form-control" type="text" name="bguarantor_name"
                                value="{{ old('bguarantor_name') }}">
                            @error('bguarantor_name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlFile1">4. Type of Loan Availed</label>
                            <input class="form-control" type="text" name="loan_type" value="{{ old('loan_type') }}">
                            @error('loan_type')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlFile1">5. Amount of Sanction</label>
                            <input class="form-control" type="text" name="amount_of_sanction"
                                value="{{ old('amount_of_sanction') }}">
                            @error('amount_of_sanction')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlFile1">6. Tenure</label>
                            <input class="form-control" type="text" name="tenure" value="{{ old('tenure') }}">
                            @error('tenure')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlFile1">7. Whether compliance of last sanction terms done</label>
                            <input class="form-control" type="text" name="whether_compliance_of_last_sanction_terms_done"
                                disabled>
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlFile1">8. Deviation from last sanction terms</label>
                            <input class="form-control" type="text" name="deviation_from_last_sanction_terms" disabled>
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
                            <label for="exampleFormControlFile1" class="text-dark">12. Occurrence of irregularity in
                                the
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
                            <label for="exampleFormControlFile1">e. Peak irregularity in the account</label>
                            <input class="form-control" type="text" name="peak_irregularity_in_the_account" disabled>
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlFile1">f. Comment on irregularity</label>
                            <input class="form-control" type="text" name="comment_on_irregularity" disabled>
                        </div>
                        <div class="col-12 text-right mt-3 p-0">
                            <button class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!--Script-->

    <!--[if lt IE 9]>
              <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
              <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
             <![endif]-->
    </body>

    </html>
@endsection
