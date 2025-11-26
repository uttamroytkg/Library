@extends('layouts.app')
@section('title', 'LMS | All Books')

@section('main')
                    <!-- Page Header -->
					<div class="page-header">
						<div class="row">
							<div class="col-sm-12">
								<h3 class="page-title">All Books</h3>
								<ul class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{ url('/') }}">Dashboard</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Books</li>
								</ul>
							</div>
						</div>
					</div>
					<!-- /Page Header -->

					{{-- Books Table  --}}
					<div class="row">
                        <div class="col-12">
                            <a class="btn btn-primary mb-3" href="{{ route('book.create') }}">Add new Book</a>
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
													<th>Book</th>
													<th>Author</th>
													<th>ISBN</th>
													<th>Copies</th>
													<th>Available Copies</th>
													<th>Created Time</th>
													<th>Action</th>
												</tr>
											</thead>
											<tbody>
                                                @forelse ($books as $book)
												<tr>
													<td>{{ $loop -> iteration }}</td>
													<td>
                                                        <div class="d-flex align-items-center">
															<div class="book-cover-image mr-2"><img class="avatar-img" src="{{ URL::to($book->cover) }}" alt="Cover"></div>
															<p class="mb-0">{{ $book->title }}</p>
														</div>
                                                    </td>
													<td>{{ $book->author }}</td>
													<td>{{ $book->isbn }}</td>
													<td>{{ $book->copies }}</td>
													<td>{{ $book->available_copy }}</td>
													<td>{{ \Carbon\Carbon::parse($book->created_at)->diffForHumans() }}</td>
													<td>
                                                        <div class="actions">
															<a class="btn btn-sm bg-success-light" href="{{ route('book.show', $book->id) }}">
																<i class="fe fe-eye"></i> View
															</a>
															<a class="btn btn-sm bg-warning-light" href="{{ route('book.edit', $book->id) }}">
																<i class="fe fe-pencil"></i> Edit
															</a>
															<a class="btn btn-sm bg-danger-light" data-url="{{ route('book.destroy', $book->id) }}" data-toggle="modal" href="#delete_modal">
																<i class="fe fe-trash"></i> Delete
															</a>
														</div>
                                                    </td>
												</tr>
                                                 @empty
												<tr>
													<td colspan="8" class="text-center text-muted">No books available</td>
												</tr>
												@endforelse
											</tbody>
										</table>
									</div>
								</div>
							</div>
						</div>
					</div>


					<!-- Delete Modal -->
					<div class="modal fade" id="delete_modal" aria-hidden="true" role="dialog">
						<div class="modal-dialog modal-dialog-centered" role="document" >
							<div class="modal-content">
								<div class="modal-body">
									<div class="form-content p-2">
										<h4 class="modal-title">Delete</h4>
										<p class="mb-4">Are you sure want to delete?</p>
										<form id="deleteForm" method="POST" style="display: inline;">
											@csrf
											@method('DELETE')
											<button type="submit" class="btn btn-danger">Yes, Delete</button>
										</form>
										<button type="button" class="btn btn-warning" data-dismiss="modal">Close</button>
									</div>
								</div>
							</div>
						</div>
					</div>
					<!-- /Delete Modal -->
@endsection

@push('script')
	<script>
		// Delete Script 
		$('#delete_modal').on('show.bs.modal', function (event) {
			var button = $(event.relatedTarget); 
			var deleteUrl = button.data('url'); 
			$('#deleteForm').attr('action', deleteUrl);
		});
	</script>
@endpush