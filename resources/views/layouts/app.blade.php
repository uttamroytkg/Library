<!DOCTYPE html>
<html lang="en">
    
<head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
        <title>@yield('title', 'Library Management System')</title>
		
		<!-- Favicon -->
        <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/img/favicon.png') }}">
		
		<!-- Bootstrap CSS -->
        <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
		
		<!-- Fontawesome CSS -->
        <link rel="stylesheet" href="{{ asset('assets/css/font-awesome.min.css') }}">
		
		<!-- Feathericon CSS -->
        <link rel="stylesheet" href="{{ asset('assets/css/feathericon.min.css') }}">
		
		<link rel="stylesheet" href="{{ asset('assets/plugins/morris/morris.css') }}">

		<!-- Datatables CSS -->
		<link rel="stylesheet" href="{{ asset('assets/plugins/datatables/datatables.min.css') }}">
		
		<!-- Main CSS -->
        <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
		
		<!--[if lt IE 9]>
			<script src="assets/js/html5shiv.min.js"></script>
			<script src="assets/js/respond.min.js"></script>
		<![endif]-->
		<style>
			.book-cover-image{
				width: 5rem;
				height: 7rem;
			}
			.book-cover-image > img{
				width: 100%;
				height: 100%;
				object-fit: contain;
			}
			.submenu > a.active{
				    background-color: #00d0f1;
					color: #fff;
			}
			.card-student-img{
				aspect-ratio: 1 / 1;
				object-fit: cover;
			}
			.card-book-cover{
				aspect-ratio: 1 / 1.2;
    			object-fit: cover;
			}
			.profile-header img{
				aspect-ratio: 1 / 1;
				object-fit: cover
			}
		</style>

		@stack('css')
    </head>
    <body>
	
		<!-- Main Wrapper -->
        <div class="main-wrapper">
		
			@include('layouts.components.header')
			
			@include('layouts.components.sidebar')
			
			<!-- Page Wrapper -->
            <div class="page-wrapper">
			
                <div class="content container-fluid">
					
					@section('main')
                    @show
					
				</div>			
			</div>
			<!-- /Page Wrapper -->
		
        </div>
		<!-- /Main Wrapper -->
		
		<!-- jQuery -->
        <script src="{{ asset('assets/js/jquery-3.2.1.min.js') }}"></script>
		
		<!-- Bootstrap Core JS -->
        <script src="{{ asset('assets/js/popper.min.js') }}"></script>
        <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
		
		<!-- Slimscroll JS -->
        <script src="{{ asset('assets/plugins/slimscroll/jquery.slimscroll.min.js') }}"></script>
		
		<script src="{{ asset('assets/plugins/raphael/raphael.min.js') }}"></script>    
		<script src="{{ asset('assets/plugins/morris/morris.min.js') }}"></script>  
		<script src="{{ asset('assets/js/chart.morris.js') }}"></script>

		<!-- Datatables JS -->
		<script src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
		<script src="{{ asset('assets/plugins/datatables/datatables.min.js') }}"></script>
		
		<!-- Custom JS -->
		<script  src="{{ asset('assets/js/script.js') }}"></script>
		@stack('script')
		
    </body>

</html>