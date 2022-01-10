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
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
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
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($all_loan_details as $key => $loan)
                                        <tr class="bg-tr">
                                            <td>{{ $key + 1 }}</td>
                                            <th>
                                                @php 
                                                    if($loan->user_id){
                                                        $user_details = App\Models\User::find($loan->user_id);
                                                        echo $user_details->first_name .' '.$user_details->last_name; 
                                                    }
                                                    
                                                @endphp
                                            </th>
                                            <td>{{ date('d-M-Y',strtotime($loan->created_at)) }}</td>
                                            <th>
                                                @if ($loan->status == 1 && $loan->o_verified_status == 1 && $loan->a_verified_status == '')
                                                    <span data-toggle="tooltip" data-placement="top" title="This form is submitted by the operation deperment">
                                                        <p class="badge badge-success">Sumitted</p>
                                                    </span>
                                                @endif
                                                @if ($loan->status == 3)
                                                    <span data-toggle="tooltip" data-placement="top" title="This form is verified by the operation deperment">
                                                        <p class="badge badge-success">Verified by Operation Dept</p>
                                                    </span>
                                                @endif
                                                @if ($loan->status == 1 && $loan->o_verified_status == 1 && $loan->a_verified_status == 0)
                                                    <span data-toggle="tooltip" data-placement="top" title="This form is verified by the operation deperment">
                                                        <p class="badge badge-success">Verified by Operation Dept</p>
                                                    </span>
                                                @endif
                                                @if ($loan->status == 2)
                                                    <span data-toggle="tooltip" data-placement="top" title="This form is revert back to the operation deperment due to insufficient documents">
                                                        <p class="badge badge-warning">Revert Back</p>
                                                    </span>
                                                    
                                                @elseif($loan->status == 4)
                                                    <span data-toggle="tooltip" data-placement="top" title="This form is reviewd by the operation deperment">
                                                        <p class="badge badge-primary">Updated</p>
                                                    </span>
                                                @endif
                                                @if ($loan->status == 5)
                                                     <span data-toggle="tooltip" data-placement="top" title="This form is reviewd by the operation deperment">
                                                        <p class="badge badge-primary">Completed</p>
                                                    </span>
                                                @endif
                                            </th>
                                            
                                            <td>
                                                @if ($loan->revert_user_id != '')
                                                <span  data-toggle="tooltip" data-placement="top" title="View Form">
                                                    <a href="{{ route('accountant_user.loan.show',$loan->id) }}"><i
                                                        class="fa fa-eye"></i></a>
                                                </span>
                                                @endif
                                                @if ($loan->status == 5)
                                                <span  data-toggle="tooltip" data-placement="top" title="Download Form">
                                                    <a href="{{ route('accountant_user.generatePDF',$loan->id) }}"><i
                                                        class="fa fa-download ml-2"></i></a>
                                                </span>
                                                @endif
                                                @if ($loan->status == 1 && $loan->revert_user_id == '' && $loan->a_verified_status == 0)
                                                <span  data-toggle="tooltip" data-placement="top" title="Review Form">
                                                    <a href="{{ route('accountant_user.loan.edit', $loan->id) }}"
                                                        class="ml-2"><i class="fa fa-edit"></i></a>
                                                </span>
                                                @endif
                                                @if ($loan->status == 3)
                                                <span  data-toggle="tooltip" data-placement="top" title="Review Form">
                                                    <a href="{{ route('accountant_user.loan.edit', $loan->id) }}"
                                                        class="ml-2"><i class="fa fa-edit"></i></a>
                                                </span>
                                                @endif
                                                @if ($loan->revert_user_id != '' && $loan->is_modify_details_by_operation_dept == 1 && $loan->a_verified_status == 0)
                                                <span  data-toggle="tooltip" data-placement="top" title="Review Form">
                                                    <a href="{{ route('accountant_user.loan.edit', $loan->id) }}"
                                                        class="ml-2"><i class="fa fa-edit"></i></a>
                                                </span>
                                                @endif
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