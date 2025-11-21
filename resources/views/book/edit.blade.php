@extends('layouts.app')
@section('title', 'LMS | Book Edit')

@section('main')
                    <!-- Page Header -->
					<div class="page-header">
						<div class="row">
							<div class="col-sm-12">
								<h3 class="page-title">Book Edit</h3>
								<ul class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{ route('book.index') }}">All Books</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Book Edit</li>
								</ul>
							</div>
						</div>
					</div>
					<!-- /Page Header -->

					{{-- Book Edit --}}
					<div class="row">
						<div class="col-md-12">
							<div class="card">
                                <div class="card-body">
                                    @include('layouts.components.message')
									<form action="{{ route('book.update', $book->id) }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')
										<div class="form-group">
											<label>Book Title</label>
											<input type="text" name="title" class="form-control" value="{{ $book->title }}">
										</div>
										<div class="form-group">
											<label>Author Name</label>
											<input type="text" name="author" class="form-control" value="{{ $book->author }}">
										</div>
										<div class="form-group">
                                            <label>ISBN Number</label>
											<input type="text" name="isbn" class="form-control" value="{{ $book->isbn }}">
										</div>
                                        <div class="form-group">
                                            <label>Copies</label>
                                            <input type="text" name="copies" class="form-control" value="{{ $book->copies }}">
											<p class="mt-1" style="font-size: 14px">Available Copies {{ $book->available_copy }}</p>
                                        </div>
                                        <div class="form-group">
                                            <label>Current Book Cover</label>
                                            <div class="book-cover-image mb-2">
                                                <img src="{{ URL::to($book->cover) }}" alt="Cover">
                                            </div>
                                            <label class="d-block">Add New Book Cover</label>
                                            <input type="file" name="cover" class="form-control">
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