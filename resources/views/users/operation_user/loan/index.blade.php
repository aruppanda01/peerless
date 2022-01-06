@extends('users.layouts.master')
@section('content')
    <style>
        .table thead th {
            font-size: 14px !important;
        }

    </style>
    <div class="app-main__outer">
        <div class="app-main__inner">
            <div class="app-page-title">
                <div class="page-title-wrapper">
                    <div class="page-title-heading">
                        <div class="page-title-icon">
                            <i class="fa fa-graduation-cap"></i>
                        </div>
                        <div>Loan
                        </div>
                    </div>
                </div>
            </div>
            <h5>Loan</h5>
            <div class="tabs-animation">
                <div class="card mb-3">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover" id="loan_table">
                                <thead>
                                    <tr>
                                        <th>Serial no</th>
                                        <th>Upload By</th>
                                        <th>Upload Date</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($all_loan_details as $key => $loan)
                                        <tr class="bg-tr">
                                            <td>{{ $key + 1 }}</td>
                                            <th>{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</th>
                                            <td>{{ date('d-M-Y',strtotime($loan->created_at)) }}</td>
                                            <td>
                                                {{-- <a href="{{ route('operation_user.loan.show') }}"><i
                                                    class="far fa-eye"></i></a> --}}
                                                <span  data-toggle="tooltip" data-placement="top" title="Review Form">
                                                    <a href="{{ route('operation_user.loan.edit', $loan->id) }}"
                                                        class="ml-2"><i class="fa fa-edit"></i></a>
                                                </span>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>

        </div>

        @include('users.layouts.static_footer')
    </div>
    </div>
    </div>
    <script>
        $(document).ready(function() {
            $('#loan_table').DataTable();
        });
    </script>
@endsection