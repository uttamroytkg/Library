@extends('layouts.app')
@section('title', 'LMS | All Returned Borrows')

@section('main')
                    <!-- Page Header -->
					<div class="page-header">
						<div class="row">
							<div class="col-sm-12">
								<h3 class="page-title">All Returned Borrowing</h3>
								<ul class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{ url('/') }}">Dashboard</a></li>
                                    <li class="breadcrumb-item"><a href="{{ route('borrow.index') }}">Borrows</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Returned Borrows</li>
								</ul>
							</div>
						</div>
					</div>
					<!-- /Page Header -->

					{{-- Borrows Table  --}}
					<div class="row">
                        <div class="col-12">
                            <a class="btn btn-primary mb-3" href="{{ route('borrow.index') }}">Back to Borrows</a>
                        </div>
						<div class="col-sm-12">
							<div class="card">
								<div class="card-body">
									@include('layouts.components.message')
									<div class="table-responsive">
										<table class="datatable table table-hover table-center mb-0">
											<thead>
												<tr>
													<th>#</th>
													<th>Student</th>
													<th>Book</th>
													<th>Status</th>
													<th>Issue Date</th>
													<th>Return Date</th>
													<th>Created at</th>
													<th>Action</th>
												</tr>
											</thead>
											<tbody>
                                                @forelse ($borrows as $borrow)
												<tr>
													<td>{{ $loop -> iteration }}</td>
													<td>
                                                        <h2 class="table-avatar">
															<a href="{{ route('student.show', $borrow->student_id) }}" class="avatar avatar-sm mr-2 d-block"><img class="avatar-img rounded-circle" src="{{ URL::to($borrow->photo) }}" alt="User Image"></a>
															<a href="{{ route('student.show', $borrow->student_id) }}">{{ $borrow->name }}</a>
														</h2>
                                                    </td>
													<td>
                                                        <h2 class="table-avatar">
															<div class="avatar avatar-lg mr-2"><img class="avatar-img" src="{{ URL::to($borrow->cover) }}" alt="User Image"></div>
															<p class="mb-0">{{ $borrow->title }}</p>
														</h2>
                                                    </td>
													<td>
														<span class="badge badge-success">
															{{ ucfirst($borrow->status) }}
														</span>
													</td>
													<td>{{ date('F d, Y', strtotime($borrow->issue_date)) }}</td>
													<td>{{ ceil(\Carbon\Carbon::now()->diffInDays( \Carbon\Carbon::parse($borrow->return_date, false))) }} Days</td>
													<td>{{ \Carbon\Carbon::parse($borrow->created_at)->diffForHumans() }}</td>
													<td>
                                                        <div class="actions">
															<a class="btn btn-sm bg-success-light" href="{{ route('borrow.return', $borrow->id) }}">
																Make Pending
															</a>
															<a class="btn btn-sm bg-warning-light" href="{{ route('borrow.destroy', $borrow->id) }}">
																<i class="fe fe-trash"></i> Delete
															</a>
														</div>
                                                    </td>
												</tr>
                                                 @empty
												<tr>
													<td colspan="8" class="text-center text-muted">No returned borrows available</td>
												</tr>
												@endforelse
											</tbody>
										</table>
									</div>
								</div>
							</div>
						</div>
					</div>
@endsection