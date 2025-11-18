@extends('layouts.app')
@section('title', 'LMS | Borrow Edit')

@section('main')
                    <!-- Page Header -->
					<div class="page-header">
						<div class="row">
							<div class="col-sm-12">
								<h3 class="page-title">Borrow Edit</h3>
								<ul class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{ route('borrow.index') }}">All Borrows</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Borrow Edit</li>
								</ul>
							</div>
						</div>
					</div>
					<!-- /Page Header -->

					{{-- Book Edit --}}
					<div class="row">
						<div class="col-md-8 col-lg-7 col-xl-6">
							<div class="card">
                                <div class="card-body">
                                    @include('layouts.components.message')
									<form action="{{ route('borrow.update', $borrow->id) }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')
                                        <div class="form-group">
                                            <label>Return Date</label>
                                            <input name="return_date" type="date" class="form-control" value="{{ $borrow->return_date }}">
                                        </div>
                                        <div class="form-group">
                                            <label>Selected Book</label>
                                            <div class="book-cover-image mb-2">
                                                <img src="{{ URL::to($borrow->book_cover) }}" alt="Cover">
                                            </div>
                                            <label class="d-block">Change Book</label>
                                            <select name="book_id" class="form-control">
                                                @foreach ($books as $book)
                                                <option value="{{ $book->id }}" @if($borrow->selected_book_id == $book->id) selected @endif>{{ $book->title }}</option>
                                                @endforeach
                                            </select>
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