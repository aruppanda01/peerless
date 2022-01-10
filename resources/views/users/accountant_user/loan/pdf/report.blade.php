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
                <td>1. Borrower’s Name</td>
                <td>{{ $loan_details->borrower_name }}</td>
            </tr>
            <tr>
                <td>2. BCo-Borrower’s Name</td>
                <td>{{ $loan_details->bco_borrower_name }}</td>
            </tr>
            <tr>
                <td>3. BGuarantor’s Name</td>
                <td>{{ $loan_details->bguarantor_name }}</td>
            </tr>
            <tr>
                <td>4. Type of Loan Availed</td>
                <td>{{ $loan_details->loan_type }}</td>
            </tr>
            <tr>
                <td>5. Amount of Sanction</td>
                <td>{{ $loan_details->amount_of_sanction }}</td>
            </tr>
            <tr>
                <td>6. Tenure</td>
                <td>{{ $loan_details->tenure }}</td>
            </tr>
            <tr>
                <td>7. Whether compliance of last sanction terms done</td>
                <td>{{ $loan_details->whether_compliance_of_last_sanction_terms_done }}</td>
            </tr>
            <tr>
                <td>8. Deviation from last sanction terms</td>
                <td>{{ $loan_details->deviation_from_last_sanction_terms }}</td>
            </tr>
            <tr>
                <td>9. Amount O/s as on</td>
                <td>{{ $loan_details->amount_O_s_as_on }}</td>
            </tr>
            <tr>
                <td>10. Residual Tenure</td>
                <td>{{ $loan_details->residual_tenure }}</td>
            </tr>
            <tr>
                <td>11. Utilization of Limit</td>
                <td>{{ $loan_details->utilization_of_limit }}</td>
            </tr>
            <tr>
                <td>12. Occurrence of irregularity in the
                    account since Operational</td>
            </tr>
            <tr>
                <td>a. No. of times Bounces in the account</td>
                <td>{{ $loan_details->no_of_times_bounces_in_the_account }}</td>
            </tr>
            <tr>
                <td>b. Any bounces in last six months</td>
                <td>{{ $loan_details->any_bounces_in_last_six_months }}</td>
            </tr>
            <tr>
                <td>c. No. of times and days, the account was irregular</td>
                <td>{{ $loan_details->no_of_times_and_days }}</td>
            </tr>
            <tr>
                <td>d. Reasons for the irregularity (ies)</td>
                <td>{{ $loan_details->reasons_for_the_irregularity }}</td>
            </tr>
            <tr>
                <td>e. Peak irregularity in the account</td>
                <td>{{ $loan_details->peak_irregularity_in_the_account }}</td>
            </tr>
            <tr>
                <td>f. Comment on irregularity</td>
                <td>{{ $loan_details->comment_on_irregularity }}</td>
            </tr>
        </tbody>
    </table>
</body>
</html>
