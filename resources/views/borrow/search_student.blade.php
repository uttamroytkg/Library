@extends('layouts.app')
@section('title', 'LMS | Search Students')

@section('main')
                    <!-- Page Header -->
					<div class="page-header">
						<div class="row">
							<div class="col-sm-12">
								<h3 class="page-title">Search Student</h3>
								<ul class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{ route('borrow.index') }}">Borrows</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Search Student</li>
								</ul>
							</div>
						</div>
					</div>
					<!-- /Page Header -->

					{{-- Search Student  --}}
					<div class="row">
                        <div class="col-12">
                            <a class="btn btn-primary mb-3" href="{{ route('borrow.index') }}">Back to Borrows</a>
                        </div>
					</div>
                    <div class="row">
                        <div class="col-md-8">
							<div class="card">
								<div class="card-header">
									<h4 class="card-title">Student Search Form</h4>
								</div>
								<div class="card-body">
									<form action="{{ route('borrow.search-student') }}" method="POST">
                                        @csrf
										<div class="form-group">
											<label>Student ID/Email/Phone number:</label>
											<input type="text" name="search" class="form-control">
										</div>
										<div>
											<button type="submit" class="btn btn-primary">Search</button>
										</div>
									</form>
								</div>
							</div>
						</div>
                    </div>
					<div class="row">
                        @forelse ($students as $student)
                        <div class="col-12 col-sm-6 col-lg-4 col-xl-3 d-flex">
                            <div class="card flex-fill">
                                <img alt="Card Image" src="{{ URL::to($student->photo) }}" class="card-img-top card-student-img">
                                <div class="card-header">
                                    <h5 class="card-title mb-0">{{ $student->name }}</h5>
                                </div>
                                <div class="card-body">
                                    <p class="card-text"><strong>Address: </strong>{{ $student->address }}</p>
                                    <p class="card-text"><strong>Mobile: </strong>{{ $student->phone }}</p>
                                    <a class="btn btn-primary" href="{{ route('borrow.assign', $student->id) }}">Assign Book</a>
                                </div>
                            </div>
                        </div>
                        @empty
                            <div class="col-12">
                                <h3 class="page-title mb-3">Student not found!</h3>
                                <a class="btn btn-primary" href="{{ route('student.create') }}">Create New Student</a>
                            </div>
                        @endforelse
					</div>
@endsection