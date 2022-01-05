@extends('users.layouts.master')
@section('content')
    <div class="app-main__outer">
        <div class="app-main__inner">
            <div class="app-page-title">
                <div class="page-title-wrapper">
                    <div class="page-title-heading">
                        <div class="page-title-icon">
                            <i class="fa fa-graduation-cap"></i>
                        </div>
                        <div>Profile
                        </div>
                    </div>
                </div>
            </div>
            <div class="tabs-animation">
                <div class="bg-edit p-4">
                    <div class="row">
                        <div class="col-lg-3">
                            <img src="{{ asset('frontend/assets/images/avata3.jpg') }}"
                                class="img-fluid mx-auto">
                        </div>
                        <div class="col-lg-4 not2">
                            <h4 class="mb-4">{{ Auth::user()->first_name }}
                                {{ Auth::user()->last_name }}<span class="ml-3">
                                    <!-- <img src="assets/images/edit.png" class="img-fluid mx-auto"> -->
                                </span></h4>
                            <div class="row">
                                <div class="col-md-4">
                                    <label>Email :</label>
                                </div>
                                <div class="col-md-6">
                                    <p id="dob">{{ Auth::user()->email ? Auth::user()->email : 'N/A' }}</p>
                                </div>
                                <div class="col-md-2">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <label>DOB :</label>
                                </div>
                                <div class="col-md-6">
                                    <p id="dob">{{ Auth::user()->dob ? Auth::user()->dob : 'N/A' }}</p>
                                </div>
                                <div class="col-md-2">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <label>Age :</label>
                                </div>
                                <div class="col-md-6">
                                    <p>{{ $user_age ? $user_age : 'N/A' }}</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <label>Sex :</label>
                                </div>
                                <div class="col-md-6">
                                    <p id="gender">{{ $user_details->gender ? $user_details->gender : 'N/A' }}</p>
                                </div>
                                <div class="col-md-2">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <label>Id No :</label>
                                </div>
                                <div class="col-md-6">
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
    @include('users.layouts.static_footer')
    </div>
    </div>
    </div>
@endsection
