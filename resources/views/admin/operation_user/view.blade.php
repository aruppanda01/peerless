@extends('admin.layouts.master')

@section('content')
    <div class="dashboard-body" id="content">
        <div class="dashboard-content">
            <div class="row m-0 dashboard-content-header">
                <div class="col-lg-6 d-flex">
                    <a id="sidebarCollapse" href="javascript:void(0);">
                        <i class="fas fa-bars"></i>
                    </a>
                    <ul class="breadcrumb p-0">
                        <li><a href="{{ route('admin.dashboard') }}">Home</a></li>
                        <li class="text-white"><i class="fa fa-chevron-right"></i></li>
                        <li><a href="{{ route('admin.operation-user.index') }}">Operation User List</a></li>
                        <li class="text-white"><i class="fa fa-chevron-right"></i></li>
                        <li><a href="#" class="active">User
                                Details</a></li>
                    </ul>
                </div>
                @include('admin.layouts.navbar')
            </div>
            <hr>
            <div class="app-main__inner">
                <div class="app-page-title">
                    <div class="page-title-wrapper d-sm-flex justify-content-between">
                        <div class="page-title-heading">
                            <div class="page-title-icon">
                                <i class="fa fa-graduation-cap"></i>
                            </div>
                            <div>Profile
                            </div>
                        </div>
                        <div class="mr-3">
                            @if ($user_details->status == 0)
                                    <a href="{{ route('admin.operation-user.approve', $user_details->id) }}"
                                        class="btn btn-info pull-right" onclick="activeAccount({{ $user_details->id }})"
                                        id="activeAccount">Approve</a>
                            @else
                                @if ($user_details->is_deactivated == 0)
                                    <a href="{{ route('admin.operation-user.deactivate', $user_details->id) }}"
                                        class="btn btn-danger pull-right" onclick="deactivateAccount({{ $user_details->id }})"
                                        id="deactivateAccount" data-toggle="tooltip">Deactivate</a>
                                @elseif ($user_details->is_deactivated == 1)
                                    <a href="{{ route('admin.operation-user.activate', $user_details->id) }}"
                                        class="btn btn-info pull-right" onclick="activate_account({{ $user_details->id }})"
                                        id="activateAccount">Activate</a>
                                @endif
                            @endif
                        </div>
                    </div>
                </div>
                <div class="tabs-animation">
                    <div class="bg-edit p-4">
                        @if ($user_details->status == 1 && $user_details->is_deactivated == 0)
                            <h5 class="">This account is verified<i
                                    class="text-success fa fa-check-circle"></i></h5>
                        @elseif ($user_details->status == 0 && $user_details->rejected == 0)
                            <h5 class="">This account is not verified <i
                                    class="text-danger fa fa-exclamation-circle"></i></h5>
                        @elseif ($user_details->status == 1 && $user_details->is_deactivated == 1)
                            <h5 class="">This account is deactivated <i
                                    class="text-danger fa fa-times-circle"></i></h5>
                        @endif
                        <div class="row">
                            <div class="col-lg-4 not2">
                                <h4 class="mb-4">{{ $user_details->first_name . ' ' . $user_details->last_name }}<span
                                        class="ml-3">
                                        <!-- <img src="assets/images/edit.png" class="img-fluid mx-auto"> -->
                                    </span></h4>
                                <div class="row">
                                    <div class="col-md-7">
                                        <label>Email :</label>
                                    </div>
                                    <div class="col-md-5">
                                        <p>{{ $user_details->email ? $user_details->email : 'N/A' }}</p>
                                    </div>
                                    <div class="col-md-2">
                                        {{-- <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg> --}}
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-7">
                                        <label>Mobile No :</label>
                                    </div>
                                    <div class="col-md-5">
                                        <p>
                                            {{ $user_details->mobile ? $user_details->mobile : 'N/A' }}
                                        </p>
                                    </div>
                                    <div class="col-md-2">
                                        {{-- <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg> --}}
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-7">
                                        <label> Id No :</label>
                                    </div>
                                    <div class="col-md-5">
                                        <p>{{ $user_details->id_no ? $user_details->id_no : 'N/A' }}</p>
                                    </div>
                                    <div class="col-md-2">
                                        <!-- <img src="assets/images/edit.png" class="img-fluid mx-auto"> -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>

        // For approve an account
        function activeAccount(student_id, status) {
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
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, APPROVE it!',
                cancelButtonText: 'No, cancel!',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    event.preventDefault();
                    let url = $("#activeAccount").attr('href');
                    let data = {
                        student_id: student_id,
                        status: status
                    };
                    $.ajax({
                        url: url,
                        type: "PUT",
                        data: data,
                        dataType: 'json',
                        beforeSend: function() {
                            $("#activeAccount").text('Loading...')
                        },
                        success: function(response) {
                            if (response.data === 'activated') {
                                location.reload();
                            } else {
                                location.reload();
                            }
                        }
                    })
                } else if (
                    /* Read more about handling dismissals below */
                    result.dismiss === Swal.DismissReason.cancel
                ) {
                    swalWithBootstrapButtons.fire(
                        'Cancelled',
                        'This account status remain same :)',
                        'error'
                    )
                }
            })


        }

        // For deactivate an account
        function deactivateAccount(student_id, status) {
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
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, DEACTIVATE it!',
                cancelButtonText: 'No, cancel!',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    event.preventDefault();
                    let url = $("#deactivateAccount").attr('href');
                    let data = {
                        student_id: student_id,
                        status: status
                    };
                    $.ajax({
                        url: url,
                        type: "PUT",
                        data: data,
                        dataType: 'json',
                        beforeSend: function() {
                            $("#deactivateAccount").text('Loading...')
                        },
                        success: function(response) {
                            if (response.data === 'inactivated') {
                                location.reload();
                            } else {
                                location.reload();
                            }
                        }
                    })
                } else if (
                    /* Read more about handling dismissals below */
                    result.dismiss === Swal.DismissReason.cancel
                ) {
                    swalWithBootstrapButtons.fire(
                        'Cancelled',
                        'This account status remain ACTIVE :)',
                        'error'
                    )
                }
            })

        }

        // For activate an account
        function activate_account(student_id, status) {
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
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, ACTIVATE it!',
                cancelButtonText: 'No, cancel!',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    event.preventDefault();
                    let url = $("#activateAccount").attr('href');
                    let data = {
                        student_id: student_id,
                        status: status
                    };
                    $.ajax({
                        url: url,
                        type: "PUT",
                        data: data,
                        dataType: 'json',
                        beforeSend: function() {
                            $("#activateAccount").text('Loading...')
                        },
                        success: function(response) {
                            if (response.data === 'inactivated') {
                                location.reload();
                            } else {
                                location.reload();
                            }
                        }
                    })
                } else if (
                    /* Read more about handling dismissals below */
                    result.dismiss === Swal.DismissReason.cancel
                ) {
                    swalWithBootstrapButtons.fire(
                        'Cancelled',
                        'This account status remain DEACTIVATE :)',
                        'error'
                    )
                }
            })

        }
    </script>
@endsection
