@extends('layouts.app')
@section('title', 'LMS | Book Details')

@section('main')
                    <!-- Page Header -->
					<div class="page-header">
						<div class="row">
							<div class="col-sm-12">
								<h3 class="page-title">Book Details</h3>
								<ul class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{ route('book.index') }}">All Books</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Book Details</li>
								</ul>
							</div>
						</div>
					</div>
					<!-- /Page Header -->

					{{-- Book Details --}}
					<div class="row">
						<div class="col-lg-10 col-xl-8">
							<div class="card">
                                <div class="row justify-content-center align-items-center">
                                    <div class="col-md-5 col-sm-8">
                                        <div class="w-100 border border-primary">
                                            <img class="w-100" src="{{ URL::to($book->cover) }}" alt="">
                                        </div>
                                    </div>
                                    <div class="col-md-7">
                                        <div class="card-body">
                                            <div class="py-4 my-4">
                                                <h2 class="card-title">{{ $book->title }}</h2>
                                                <p><b>By:</b> {{ $book->author }}</p>
                                                <ul class="list-group list-group-flush mt-5">
                                                    <li class="list-group-item px-0"><strong>ISBN Number: </strong>{{ $book->isbn }}</li>
                                                    <li class="list-group-item px-0"><strong>Total Copies: </strong>{{ $book->copies }}</li>
                                                    <li class="list-group-item px-0"><strong>Available Copies: </strong>{{ $book->available_copy }}</li>
                                                    <li class="list-group-item px-0"><strong>Created Date Time: </strong>{{ $book->created_at }}</li>
                                                    <li class="list-group-item px-0 border-bottom"><strong>Updated Date Time: </strong>{{ $book->updated_at }}</li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
							</div>
						</div>
					</div>
@endsection