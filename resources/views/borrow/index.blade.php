@extends('layouts.app')
@section('title', 'LMS | All Borrows')

@section('main')
                    <!-- Page Header -->
					<div class="page-header">
						<div class="row">
							<div class="col-sm-12">
								<h3 class="page-title">All Borrowing</h3>
								<ul class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{ url('/') }}">Dashboard</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Borrows</li>
								</ul>
							</div>
						</div>
					</div>
					<!-- /Page Header -->

					{{-- Borrows Table  --}}
					<div class="row">
                        <div class="col-12">
                            <a class="btn btn-primary mb-3" href="{{ route('borrow.search') }}">Add new Borrow</a>
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
													<th>Student Name</th>
													<th>Book Name</th>
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
                                                    <td>{{ $borrow->student_id }}</td>
													<td>{{ $borrow->book_id }}</td>
													<td>{{ $borrow->status }}</td>
													<td>{{ date('F d, Y', strtotime($borrow->issue_date)) }}</td>
													<td>{{ ceil(\Carbon\Carbon::now()->diffInDays( \Carbon\Carbon::parse($borrow->return_date, false))) }} Days</td>
													<td>{{ \Carbon\Carbon::parse($borrow->created_at)->diffForHumans() }}</td>
													<td>
                                                        <div class="actions">
															<a class="btn btn-sm bg-success-light" href="{{ route('borrow.show', $borrow->id) }}">
																<i class="fe fe-eye"></i> Approve
															</a>
															<a class="btn btn-sm bg-warning-light" href="{{ route('borrow.edit', $borrow->id) }}">
																<i class="fe fe-pencil"></i> Increase time
															</a>
															<form action="{{ route('borrow.destroy', $borrow->id) }}" method="POST" class="d-inline">
																@csrf
																@method('DELETE')
																<button type="submit" class="btn btn-sm bg-danger-light" onclick="return confirm('Are you sure?')"><i class="fe fe-trash"></i> Delete</button>
															</form>
														</div>
                                                    </td>
												</tr>
                                                 @empty
												<tr>
													<td colspan="5" class="text-center text-muted">No borrow available</td>
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