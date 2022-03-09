<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Results</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <style>
        .booknow {
            background-color: #2a2a2a;
            border-color: #2a2a2a;
            border-style: solid;
            border-width: 2px 2px 2px 2px;
            border-radius: 0 0 0 0;
            padding: 13px 30px 12px 30px;
            font-weight: 700;
            font-size: 14px;
            color: #fff;
        }

        .booknow:hover {
            color: #2a2a2a;
            background-color: #fff;
            border-color: #2a2a2a;
        }

        .form_title h6 {
            font-size: 15px;
            font-weight: 600;
            display: block;
            text-align: center;
        }

        .form_title h2 {
            font-size: 24px;
            font-weight: 800;
            display: block;
            text-align: center;
            margin-bottom: 15px;
        }

        .form_title h2 span {
            display: block;
            font-size: 15px;
            font-weight: 400;
        }

        .form_title img {
            margin: 0 auto;
            margin-bottom: 20px;
        }

        .actv_bg {
            background: #d4d4d4;
        }
        .wh_class {
            border: 1px solid #efefef;
            margin-bottom: 15px;
            padding-top: 5px;
            padding-left: 5px;
        }

    </style>

</head>
<body>
    {{-- <div class="container mt-2"> --}}
        <div class="row m-0 justify-content-center pb-4 mt-2 form_title">
            <div class="d-flex">
                <img src="{{ public_path('frontend/loan/peerless_logo.png') }}">
                <h2 class="col-12 p-0">Peerless Financial Services Limited
                    <span>‘Peerless Bhavan’, 3 Esplanade East, Kolkata – 700069</span>
                </h2>
            </div>
        </div>
        <div class="row m-0 justify-content-center pb-4 mt-2 form_title">
            <h6 class="col-12 p-0">Conduct Sheet for Loan Against Salary/ Loan To Professional Loan Products (Top Up)</h6>
        </div>

    {{-- </div> --}}
    <table class="table table-striped table-bordered table-sm">
        <tbody>
            <tr>
                <th>Account No</th>
                <td>{{ $loan_details->account_no }}</td>
            </tr>
            <tr>
                <th>1. Borrower’s Name</th>
                <td>{{ $loan_details->borrower_name }}</td>
            </tr>
            <tr>
                <th>2. Co-Borrower’s Name, if any</th>
                <td>{{ $loan_details->bco_borrower_name }}</td>
            </tr>
            <tr>
                <th>3. Guarantor’s Name, if any</th>
                <td>{{ $loan_details->bguarantor_name }}</td>
            </tr>
            <tr>
                <th>4. Type of Loan Available</th>
            </tr>
            @foreach ($other_loan_details as $key => $other_loan_detail)
                <tr class="wh_class actv_bg">  
                    <td>
                        Loan - {{ $key + 1 }}
                    </td>
                    <td>{{ $other_loan_detail->loan_type}}</td>
                </tr>
            @endforeach
            
            <tr>
                <th>5. Amount of Sanction(Rs)</th>
                <td>{{ $loan_details->amount_of_sanction }}</td>
            </tr>
            @foreach ($other_loan_details as $key => $other_loan_detail)
                <tr class="wh_class actv_bg">  
                    <td>
                        Loan - {{ $key + 1 }}
                    </td>
                    <td>{{ $other_loan_detail->amount_of_sanction}}</td>
                </tr>
            @endforeach
            <tr>
                <th>6. Tenure</th>
                <td>{{ $loan_details->tenure }}</td>
            </tr>
            @foreach ($other_loan_details as $key => $other_loan_detail)
                <tr class="wh_class actv_bg">  
                    <td>
                        Loan - {{ $key + 1 }}
                    </td>
                    <td>{{ $other_loan_detail->tenure}}</td>
                </tr>
            @endforeach
            <tr>
                <th>7. Whether compliance of last sanction terms done</th>
                <td>{{ $loan_details->whether_compliance_of_last_sanction_terms_done }}</td>
            </tr>
            @foreach ($other_loan_details as $key => $other_loan_detail)
                <tr class="wh_class actv_bg">  
                    <td>
                        Loan - {{ $key + 1 }}
                    </td>
                    <td>{{ $other_loan_detail->whether_compliance_of_last_sanction_terms_done}}</td>
                </tr>
            @endforeach
            <tr>
                <th>8. Deviation from last sanction terms, if any</th>
                <td>{{ $loan_details->deviation_from_last_sanction_terms }}</td>
            </tr>
            @foreach ($other_loan_details as $key => $other_loan_detail)
                <tr class="wh_class actv_bg">  
                    <td>
                        Loan - {{ $key + 1 }}
                    </td>
                    <td>{{ $other_loan_detail->deviation_from_last_sanction_terms}}</td>
                </tr>
            @endforeach
            <tr>
                <th>9. Amount O/s as on</th>
                <td>{{ $loan_details->amount_O_s_as_on }}</td>
            </tr>
            @foreach ($other_loan_details as $key => $other_loan_detail)
                <tr class="wh_class actv_bg">  
                    <td>
                        Loan - {{ $key + 1 }}
                    </td>
                    <td>{{ $other_loan_detail->amount_O_s_as_on}}</td>
                </tr>
            @endforeach
            <tr>
                <th>10. Residual Tenure</th>
                <td>{{ $loan_details->residual_tenure }}</td>
            </tr>
            @foreach ($other_loan_details as $key => $other_loan_detail)
                <tr class="wh_class actv_bg">  
                    <td>
                        Loan - {{ $key + 1 }}
                    </td>
                    <td>{{ $other_loan_detail->residual_tenure}}</td>
                </tr>
            @endforeach
            <tr>
                <th>11. Utilization of Limit</th>
                <td>{{ $loan_details->utilization_of_limit }}</td>
            </tr>
            @foreach ($other_loan_details as $key => $other_loan_detail)
                <tr class="wh_class actv_bg">  
                    <td>
                        Loan - {{ $key + 1 }}
                    </td>
                    <td>{{ $other_loan_detail->utilization_of_limit}}</td>
                </tr>
            @endforeach
            <tr>
                <th>12. Occurrence of irregularity in the
                    account since Operational</th>
            </tr>
            <tr>
                <th>a. No. of times Bounces in the account</th>
                <td>{{ $loan_details->no_of_times_bounces_in_the_account }}</td>
            </tr>
            @foreach ($other_loan_details as $key => $other_loan_detail)
                <tr class="wh_class actv_bg">  
                    <td>
                        Loan - {{ $key + 1 }}
                    </td>
                    <td>{{ $other_loan_detail->no_of_times_bounces_in_the_account}}</td>
                </tr>
            @endforeach
            <tr>
                <th>b. Any bounces in last six months</th>
                <td>{{ $loan_details->any_bounces_in_last_six_months }}</td>
            </tr>
            @foreach ($other_loan_details as $key => $other_loan_detail)
                <tr class="wh_class actv_bg">  
                    <td>
                        Loan - {{ $key + 1 }}
                    </td>
                    <td>{{ $other_loan_detail->any_bounces_in_last_six_months}}</td>
                </tr>
            @endforeach
            <tr>
                <th>c. No. of times and days, the account was irregular</th>
                <td>{{ $loan_details->no_of_times_and_days }}</td>
            </tr>
            @foreach ($other_loan_details as $key => $other_loan_detail)
                <tr class="wh_class actv_bg">  
                    <td>
                        Loan - {{ $key + 1 }}
                    </td>
                    <td>{{ $other_loan_detail->no_of_times_and_days}}</td>
                </tr>
            @endforeach
            <tr>
                <th>d. Reasons for the irregularity (ies)</th>
                <td>{{ $loan_details->reasons_for_the_irregularity }}</td>
            </tr>
            @foreach ($other_loan_details as $key => $other_loan_detail)
                <tr class="wh_class actv_bg">  
                    <td>
                        Loan - {{ $key + 1 }}
                    </td>
                    <td>{{ $other_loan_detail->reasons_for_the_irregularity}}</td>
                </tr>
            @endforeach
            <tr>
                <th>e. Peak irregularity in the account, if any</th>
                <td>{{ $loan_details->peak_irregularity_in_the_account }}</td>
            </tr>
            @foreach ($other_loan_details as $key => $other_loan_detail)
                <tr class="wh_class actv_bg">  
                    <td>
                        Loan - {{ $key + 1 }}
                    </td>
                    <td>{{ $other_loan_detail->peak_irregularity_in_the_account}}</td>
                </tr>
            @endforeach
            <tr>
                <th>f. Comment on irregularity, if any</th>
                <td>{{ $loan_details->comment_on_irregularity }}</td>
            </tr>
            @foreach ($other_loan_details as $key => $other_loan_detail)
                <tr class="wh_class actv_bg">  
                    <td>
                        Loan - {{ $key + 1 }}
                    </td>
                    <td>{{ $other_loan_detail->comment_on_irregularity}}</td>
                </tr>
             @endforeach
            <tr>
                <th>Comment on Conduct of the Accounts:</th>
                <td>
                    @foreach ($loan_comments as $comment)
                        @if (getUserDepartmentId($comment->user_id) == 4)
                            {{ $comment->comment }}
                        @endif
                    @endforeach
                </td>
            </tr>
            <tr>
                <th>Comment on Conduct of the Operation:</th>
                <td>
                    @foreach ($loan_comments as $comment)
                        @if (getUserDepartmentId($comment->user_id) == 3)
                            {{ $comment->comment }}
                        @endif
                    @endforeach
                </td>
            </tr>
        </tbody>
    </table>
</body>
</html>
