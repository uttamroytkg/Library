@extends('layouts.app')
@section('title', 'LMS | Add new Student')

@section('main')
                    <!-- Page Header -->
					<div class="page-header">
						<div class="row">
							<div class="col-sm-12">
								<h3 class="page-title">Add new Student</h3>
								<ul class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{ route('student.index') }}">All Students</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Add Student</li>
								</ul>
							</div>
						</div>
					</div>
					<!-- /Page Header -->

					{{-- Create Student  --}}
					<div class="row">
						<div class="col-md-12">
							<div class="card">
                                <div class="card-body">
                                    @include('layouts.components.message')
									<form action="{{ route('student.store') }}" method="POST" enctype="multipart/form-data">
                                        @csrf
										<div class="form-group">
											<label>Student Name</label>
											<input type="text" name="name" class="form-control" value="{{ old('name') }}">
										</div>
										<div class="form-group">
											<label>Email</label>
											<input type="text" name="email" class="form-control" value="{{ old('email') }}">
										</div>
										<div class="form-group">
											<label>Phone Number</label>
											<input type="text" name="phone" class="form-control" value="{{ old('phone') }}">
										</div>
										<div class="form-group">
											<label>Student ID</label>
											<input type="text" name="student_id" class="form-control" value="{{ old('student_id') }}">
										</div>
                                        <div class="form-group">
                                            <label>Address</label>
                                            <input type="text" name="address" class="form-control" value="{{ old('address') }}">
                                        </div>
                                        <div class="form-group">
                                            <label>Student Photo</label>
                                            <input type="file" name="photo" class="form-control">
                                        </div>
										<div>
											<button type="submit" class="btn btn-primary">Add Now</button>
										</div>
									</form>
								</div>
							</div>
						</div>
					</div>
@endsection