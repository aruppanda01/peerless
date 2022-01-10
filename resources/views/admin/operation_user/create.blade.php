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
					<li><a href="{{ route('admin.dashboard')}}">Home</a></li>
					<li class="text-white"><i class="fa fa-chevron-right"></i></li>
					<li><a href="{{ route('admin.operation-user.index')}}">Operation User List</a></li>
					<li class="text-white"><i class="fa fa-chevron-right"></i></li>
					<li><a href="#" class="active">Add user</a></li>
				</ul>
			</div>
			@include('admin.layouts.navbar')
		</div>
		<hr>
		<div class="dashboard-body-content">
			<h5>Add Operation User</h5>
			<hr>
			<form action="{{ route('admin.operation-user.store') }}" method="POST" enctype="multipart/form-data">
				@csrf
				<h5 class="text-blue">Basic Information</h5>
				<div class="row m-0 pt-3">
					<div class="col-lg-6">
						<div class="form-group edit-box">
							<label for="first_name">First Name<span class="text-danger">*</span></label>
							<input type="text" name="first_name" class="form-control" id="first_name" value="{{ old('first_name') }}">
							@if ($errors->has('first_name'))
							<span style="color: red;">{{ $errors->first('first_name') }}</span>
							@endif
						</div>
					</div>
					<div class="col-lg-6">
						<div class="form-group edit-box">
							<label for="last_name">Last Name<span class="text-danger">*</span></label>
							<input type="text" name="last_name" class="form-control" id="last_name" value="{{ old('last_name') }}">
							@if ($errors->has('last_name'))
							<span style="color: red;">{{ $errors->first('last_name') }}</span>
							@endif
						</div>
					</div>
					<div class="col-lg-6">
						<div class="form-group edit-box">
							<label for="email">Email Address<span class="text-danger">*</span></label>
							<input type="text" id="email" class="form-control" name="email" value="{{ old('email') }}" >
							@if ($errors->has('email'))
							<span style="color: red;">{{ $errors->first('email') }}</span>
							@endif
						</div>
					</div>
					<div class="col-lg-6">
						<div class="form-group edit-box">
							<label for="phone_no">Phone No<span class="text-danger">*</span></label>
							<input type="number" id="phone_no" class="form-control" name="phone_no" value="{{ old('phone_no') }}" >
							@if ($errors->has('phone_no'))
							<span style="color: red;">{{ $errors->first('phone_no') }}</span>
							@endif
						</div>
					</div>
					{{-- <div class="col-lg-6">
						<div class="form-group edit-box">
							<label for="gender">Gender<span class="text-danger">*</span></label>
							<select name="gender" id="gender"  class="form-control">
								<option value="Male">Male</option>
								<option value="Female">Female</option>
							</select>
							@if ($errors->has('gender'))
							<span style="color: red;">{{ $errors->first('gender') }}</span>
							@endif
						</div>
					</div>
					<div class="col-lg-6">
						<div class="form-group edit-box">
							<label for="dob">DOB<span class="text-danger">*</span></label>
							<input type="text" id="dob" class="form-control datepicker" name="dob" value="{{ old('dob') }}" >
							@if ($errors->has('dob'))
							<span style="color: red;">{{ $errors->first('dob') }}</span>
							@endif
						</div>
					</div> --}}
				</div>
				<div class="form-group d-flex justify-content-end">
					<button type="submit" class="actionbutton">SAVE</button>
				</div>
			</form>
		</div>
	</div>
</div>
<script>
	$('.datepicker').datepicker({
		format: 'yyyy-mm-dd',
		endDate: new Date(),
		// daysOfWeekDisabled: [0]
	});
</script>
@endsection