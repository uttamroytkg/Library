@extends('layouts.app')
@section('title', 'LMS | Book Edit')

@section('main')
                    <!-- Page Header -->
					<div class="page-header">
						<div class="row">
							<div class="col-sm-12">
								<h3 class="page-title">Student Edit</h3>
								<ul class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{ route('student.index') }}">All Students</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Student Edit</li>
								</ul>
							</div>
						</div>
					</div>
					<!-- /Page Header -->

					{{-- Edit Student --}}
					<div class="row">
						<div class="col-md-12">
							<div class="card">
                                <div class="card-body">
                                    @include('layouts.components.message')
									<form action="{{ route('student.update', $student->id) }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')
										<div class="form-group">
											<label>Student Name</label>
											<input type="text" name="name" class="form-control" value="{{ $student->name }}">
										</div>
										<div class="form-group">
											<label>Email</label>
											<input type="text" name="email" class="form-control" value="{{ $student->email }}">
										</div>
										<div class="form-group">
											<label>Phone Number</label>
											<input type="text" name="phone" class="form-control" value="{{ $student->phone }}">
										</div>
										<div class="form-group">
											<label>Student ID</label>
											<input type="text" name="student_id" class="form-control" value="{{ $student->student_id }}">
										</div>
                                        <div class="form-group">
                                            <label>Address</label>
                                            <input type="text" name="address" class="form-control" value="{{ $student->address }}">
                                        </div>
                                        <div class="form-group">
                                            <label>Current Profile Photo</label>
                                            <div class="avatar avatar-xxl mb-2 d-block">
                                                <img class="avatar-img rounded-circle" src="{{ URL::to($student->photo) }}" alt="Profile Image">
                                            </div>
                                            <label class="d-block">Add New Profile Photo</label>
                                            <input type="file" name="photo" class="form-control">
                                        </div>
										<div>
											<button type="submit" class="btn btn-primary">Update Now</button>
										</div>
									</form>
								</div>
							</div>
						</div>
					</div>
@endsection