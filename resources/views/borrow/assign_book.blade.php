@extends('layouts.app')
@section('title', 'LMS | Assign Book')

@section('main')
                    <!-- Page Header -->
					<div class="page-header">
						<div class="row">
							<div class="col-sm-12">
								<h3 class="page-title">Assign Book</h3>
								<ul class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{ route('borrow.search') }}">Student Search</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Assign Book</li>
								</ul>
							</div>
						</div>
					</div>
					<!-- /Page Header -->

					{{-- Assign Book  --}}
					<div class="row">
                        <div class="col-12">
                            <a class="btn btn-primary mb-3" href="{{ route('borrow.search') }}">Change Student</a>
                        </div>
					</div>
                    <div class="row">
						<div class="col-xl-8">
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
								</div>
							</div>
							<div class="profile-menu">
								<ul class="nav nav-tabs nav-tabs-solid">
									<li class="nav-item">
										<a class="nav-link active" data-toggle="tab" href="#assign_book_tab">Assign Book</a>
									</li>
									<li class="nav-item">
										<a class="nav-link" data-toggle="tab" href="#more_about_tab">More About</a>
									</li>
								</ul>
							</div>	
							<!-- Tab Container -->
							<div class="tab-content profile-tab-cont">
								
								<!-- Assign Book Tab -->
								<div class="tab-pane fade active show" id="assign_book_tab">
									<div class="card">
										<div class="card-body">
											@include('layouts.components.message')
											<h5 class="card-title mb-3">Assign Book</h5>
											<div class="row">
												<div class="col-md-10 col-lg-6">
													<form action="{{ route('borrow.store') }}" method="POST">
														@csrf
														<div class="form-group">
															<label>Select Book</label>
															<select name="book_id" class="form-control">
																@foreach ($books as $book)
																<option value="{{ $book->id }}">{{ $book->title }}</option>
																@endforeach
															</select>
														</div>
														<div class="form-group">
															<label>Return Date</label>
															<input name="return_date" type="date" class="form-control">
														</div>
														<div class="form-group">
															<input name="student_id" type="text" value="{{ $student->id }}" class="form-control" hidden>
														</div>
														<button class="btn btn-primary" type="submit">Create a Borrow</button>
													</form>
												</div>
											</div>
										</div>
									</div>
								</div>
								<!-- /Assign Book Tab -->
								
								<!-- Personal Details Tab -->
								<div id="more_about_tab" class="tab-pane fade">
									<div class="card">
										<div class="card-body">
											<h5 class="card-title">
                                                <span>Personal Details</span> 
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
                                                <p class="col-sm-4 col-md-3 col-lg-2 text-muted text-sm-right mb-0 mb-sm-3">Created At</p>
                                                <p class="col-sm-8 col-md-9 col-lg-10">{{ $student->created_at }}</p>
                                            </div>
                                            <div class="row">
                                                <p class="col-sm-4 col-md-3 col-lg-2 text-muted text-sm-right mb-0">Updated At</p>
                                                <p class="col-sm-8 col-md-9 col-lg-10 mb-0">{{ $student->updated_at }}</p>
                                            </div>
										</div>
									</div>
								</div>
								<!-- /Personal Details Tab -->
								
							</div>
							<!-- /Tab Container -->
						</div>
					</div>
@endsection



														{{-- <div class="form-group">
															<label class="col-form-label">Status</label>
															<div>
																<div class="radio">
																	<label>
																		<input type="radio" name="status"> Pending
																	</label>
																</div>
																<div class="radio">
																	<label>
																		<input type="radio" name="status"> Approved
																	</label>
																</div>
																<div class="radio">
																	<label>
																		<input type="radio" name="status"> Due
																	</label>
																</div>
															</div>
														</div> --}}