@extends('layouts.app')
@section('title', 'LMS | All Students')

@section('main')
                    <!-- Page Header -->
					<div class="page-header">
						<div class="row">
							<div class="col-sm-12">
								<h3 class="page-title">All Students</h3>
								<ul class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{ url('/') }}">Dashboard</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Students</li>
								</ul>
							</div>
						</div>
					</div>
					<!-- /Page Header -->

					{{-- Students Table  --}}
					<div class="row">
                        <div class="col-12">
                            <a class="btn btn-primary mb-3" href="{{ route('student.create') }}">Add new Student</a>
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
													<th>ID</th>
													<th>Student</th>
													<th>Address</th>
													<th>Action</th>
												</tr>
											</thead>
											<tbody>
                                                @forelse ($students as $student)
												<tr>
													<td>{{ $loop -> iteration }}</td>
                                                    <td>{{ $student->student_id }}</td>
													<td>
                                                        <h2 class="table-avatar">
															<div class="avatar avatar-sm mr-2"><img class="avatar-img rounded-circle" src="{{ URL::to($student->photo) }}" alt="User Image"></div>
															<p class="mb-0">{{ $student->name }}</p>
														</h2>
                                                    </td>
													<td>{{ $student->address }}</td>
													<td>
                                                        <div class="actions">
															<a class="btn btn-sm bg-success-light" href="{{ route('student.show', $student->id) }}">
																<i class="fe fe-eye"></i> View
															</a>
															<a class="btn btn-sm bg-warning-light" href="{{ route('student.edit', $student->id) }}">
																<i class="fe fe-pencil"></i> Edit
															</a>
															<form action="{{ route('student.destroy', $student->id) }}" method="POST" class="d-inline">
																@csrf
																@method('DELETE')
																<button type="submit" class="btn btn-sm bg-danger-light" onclick="return confirm('Are you sure?')"><i class="fe fe-trash"></i> Delete</button>
															</form>
														</div>
                                                    </td>
												</tr>
                                                 @empty
												<tr>
													<td colspan="5" class="text-center text-muted">No students available</td>
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