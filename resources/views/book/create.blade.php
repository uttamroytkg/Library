@extends('layouts.app')
@section('title', 'LMS | Add new Book')

@section('main')
                    <!-- Page Header -->
					<div class="page-header">
						<div class="row">
							<div class="col-sm-12">
								<h3 class="page-title">Add new Book</h3>
								<ul class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{ route('book.index') }}">All Books</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Add Book</li>
								</ul>
							</div>
						</div>
					</div>
					<!-- /Page Header -->

					{{-- Create Book  --}}
					<div class="row">
						<div class="col-md-12">
							<div class="card">
                                <div class="card-body">
                                    @include('layouts.components.message')
									<form action="{{ route('book.store') }}" method="POST" enctype="multipart/form-data">
                                        @csrf
										<div class="form-group">
											<label>Book Title</label>
											<input type="text" name="title" class="form-control" value="{{ old('title') }}">
										</div>
										<div class="form-group">
											<label>Author Name</label>
											<input type="text" name="author" class="form-control" value="{{ old('author') }}">
										</div>
										<div class="form-group">
                                            <label>ISBN Number</label>
											<input type="text" name="isbn" class="form-control" value="{{ old('isbn') }}">
										</div>
                                        <div class="form-group">
                                            <label>Copies</label>
                                            <input type="text" name="copies" class="form-control" value="{{ old('copies') }}">
                                        </div>
                                        <div class="form-group">
                                            <label>Book Cover</label>
                                            <input type="file" name="cover" class="form-control">
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