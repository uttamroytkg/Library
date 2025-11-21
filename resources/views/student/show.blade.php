@extends('layouts.app')
@section('title', 'LMS | Student Details')

@section('main')
                    <!-- Page Header -->
					<div class="page-header">
						<div class="row">
							<div class="col-sm-12">
								<h3 class="page-title">Student Profile</h3>
								<ul class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{ route('student.index') }}">All Students</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Student Details</li>
								</ul>
							</div>
						</div>
					</div>
					<!-- /Page Header -->

					{{-- Student Details  --}}
					<div class="row">
						<div class="col-12">
                            <div class="row">
                                <div class="col-lg-10 col-xl-8">
                                    <div class="profile-header">
                                        <div class="row align-items-center">
                                            <div class="col-auto profile-image">
                                                <a href="#">
                                                    <img class="rounded-circle" alt="User Image" src="{{ URL::to($student->photo) }}">
                                                </a>
                                            </div>
                                            <div class="col ml-md-n2 profile-user-info">
                                                <h4 class="user-name mb-0">{{ $student->name }}</h4>
                                                <h6 class="text-muted">{{ $student->email }}</h6>
                                                <div class="user-Location"><i class="fa fa-map-marker"></i> {{ $student->address }}</div>
                                            </div>
                                            <div class="col-auto profile-btn">
                                                
                                                <a href="{{ route('student.create') }}" class="btn btn-primary">
                                                    Add new Student
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Tab Buttons -->
                                    <div class="profile-menu">
                                        <ul class="nav nav-tabs nav-tabs-solid">
                                            <li class="nav-item">
                                                <a class="nav-link active" data-toggle="tab" href="#per_details_tab">About</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" data-toggle="tab" href="#books_tab">Books</a>
                                            </li>
                                        </ul>
                                    </div>	
                                    <!-- /Tab Buttons -->
                                </div>
                            </div>
                            <div class="tab-content profile-tab-cont">
								
								<!-- Personal Details Tab -->
								<div class="tab-pane fade show active" id="per_details_tab">
								
									<!-- Personal Details -->
                                    <div class="row">
                                        <div class="col-lg-10 col-xl-8">
                                            <div class="card">
                                                <div class="card-body">
                                                    <h5 class="card-title d-flex justify-content-between">
                                                        <span>Personal Details</span> 
                                                        <a class="edit-link" href="{{ route('student.edit', $student->id) }}"><i class="fa fa-edit mr-1"></i>Edit</a>
                                                    </h5>
                                                    <div class="row">
                                                        <p class="col-sm-4 col-md-3 col-lg-2 text-muted text-sm-right mb-0 mb-sm-3">Name</p>
                                                        <p class="col-sm-8 col-md-9 col-lg-10">{{ $student->name }}</p>
                                                    </div>
                                                    <div class="row">
                                                        <p class="col-sm-4 col-md-3 col-lg-2 text-muted text-sm-right mb-0 mb-sm-3">Email ID</p>
                                                        <p class="col-sm-8 col-md-9 col-lg-10">{{ $student->email }}</p>
                                                    </div>
                                                    <div class="row">
                                                        <p class="col-sm-4 col-md-3 col-lg-2 text-muted text-sm-right mb-0 mb-sm-3">Mobile</p>
                                                        <p class="col-sm-8 col-md-9 col-lg-10">{{ $student->phone }}</p>
                                                    </div>
                                                    <div class="row">
                                                        <p class="col-sm-4 col-md-3 col-lg-2 text-muted text-sm-right mb-0 mb-sm-3">Address</p>
                                                        <p class="col-sm-8 col-md-9 col-lg-10">{{ $student->address }}</p>
                                                    </div>
                                                    <div class="row">
                                                        <p class="col-sm-4 col-md-3 col-lg-2 text-muted text-sm-right mb-0 mb-sm-3">Created Date Time</p>
                                                        <p class="col-sm-8 col-md-9 col-lg-10">{{ $student->created_at }}</p>
                                                    </div>
                                                    <div class="row">
                                                        <p class="col-sm-4 col-md-3 col-lg-2 text-muted text-sm-right mb-0">Updated Date Time</p>
                                                        <p class="col-sm-8 col-md-9 col-lg-10 mb-0">{{ $student->updated_at }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /Personal Details -->

								</div>
								<!-- /Personal Details Tab -->
								
								<!-- Books Tab -->
								<div id="books_tab" class="tab-pane fade">
								
                                    <div class="row">
                                        @foreach ($borrows as $borrow)
                                        <div class="col-md-6 col-lg-4 col-xl-3 d-flex">
                                            <div class="card flex-fill">
                                                <img alt="Card Image" src="{{ URL::to($borrow->book_cover) }}" class="card-img-top card-book-cover">
                                                <div class="card-body">
                                                    <p class="card-text"><strong>Book: </strong>{{ $borrow->book_title }}</p>
                                                    <p class="card-text"><strong>Author: </strong>{{ $borrow->book_author }}</p>
                                                    <p class="card-text"><strong>ISBN: </strong>{{ $borrow->book_isbn }}</p>
                                                    <p class="card-text"><strong>Issue Date: </strong>{{ date('F d, Y', strtotime($borrow->issue_date)) }}</p>
                                                    <p class="card-text"><strong>Return Date: </strong>{{ date('F d, Y', strtotime($borrow->return_date)) }}</p>
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                        @if ($borrows->count() == 0)
                                            <div class="col-lg-10 col-xl-8">
                                                <div class="card">
                                                    <div class="card-body">
                                                        <h5 class="card-title mb-0">No Assigned Book</h5>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    </div>
								</div>
								<!-- /Books Tab -->
								
							</div>
						</div>
					</div>
@endsection