@extends('users.layouts.master')
@section('content')
@include('users.layouts.loan_page_extra_css')
<!--CSS-->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

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
        <div class="tabs-animation">
            <div class="card mb-3">
                @if (session('regular_exam_upload_success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('regular_exam_upload_success') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                @if ($errors->special_exam_upload_error->has('upload_doc'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ $errors->special_exam_upload_error->first('upload_doc') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                <span class="text-danger" id="mgs_ta"></span>
                @error('upload_doc')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-sm table-hover" id="loan_table">
                            <thead>
                                <tr>
                                    <th>Serial No</th>
                                    <th>Form Id</th>
                                    <th>Submitted Date</th>
                                    <th>Status</th>
                                    <th style="width:100px">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($all_loan as $key => $loan)
                                  <tr>
                                      <td>{{ $key + 1 }}</td>
                                      <td>{{ $loan->form_no }}</td>
                                      <td>{{ date('d-F-y',strtotime($loan->created_at)) }}</td>
                                      <td>@if ($loan->status == 5)
                                          <span class="badge badge-primary">Copmpleted</span>
                                        @else
                                        <span class="badge badge-primary">Processing</span>
                                      @endif</td>
                                      <td>
                                        @if ($loan->status == 5)
                                            <span  data-toggle="tooltip" data-placement="top" title="Download Form">
                                                <a href="{{ route('credit_user.generatePDF',$loan->id) }}"><i
                                                    class="fa fa-download ml-2"></i></a>
                                            </span>
                                        @else
                                            N/A
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
<script>
        $(document).ready(function() {
            $('#loan_table').DataTable();
        });
</script>
@endsection
