<!DOCTYPE html>
<html lang="en">
    <!doctype html>
    <html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        {{-- <title>{{ config('app.name', 'Laravel') }}</title> --}}
        <title>Narayan HMS</title>

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>

        <!-- Fonts -->
        <link rel="dns-prefetch" href="//fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}') }}" rel="stylesheet">

        <!-- Favicon -->
        <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/img/favicon.jpg') }}">

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">

        <!-- Fontawesome CSS -->
        <link rel="stylesheet" href="{{ asset('assets/css/font-awesome.min.css') }}">

        <!-- Lineawesome CSS -->
        <link rel="stylesheet" href="{{ asset('assets/css/line-awesome.min.css') }}">

        <!-- Chart CSS -->
        <link rel="stylesheet" href="{{ asset('assets/plugins/morris/morris.css') }}">

        <!-- Main CSS -->
        <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    </head>

    <body class="account-page" style="background:url({{asset('assets/img/hms-bg.jpg')}}); background-repeat: no-repeat;" >

		<!-- Main Wrapper -->
        <div class="main-wrapper">
			<div class="account-content">
				{{-- <a href="job-list.html" class="btn btn-primary apply-btn">Apply Job</a> --}}
				<div class="container">

					<!-- Account Logo -->
					<div class="account-logo">
						<a href="{{route('admin.dashboard')}}"><img src="{{asset('assets/img/narayan-logo.png')}}" style="width:75%;" alt="Aplexia HMS"></a>
					{{-- <h3>Aplexia HMS</h3> --}}
                    </div>
					<!-- /Account Logo -->

					@yield('content')
				</div>
			</div>
        </div>
		<!-- /Main Wrapper -->

		<!-- jQuery -->
        <script src="assets/js/jquery-3.5.1.min.js"></script>

		<!-- Bootstrap Core JS -->
        <script src="assets/js/popper.min.js"></script>
        <script src="assets/js/bootstrap.min.js"></script>

		<!-- Custom JS -->
		<script src="assets/js/app.js"></script>

    </body>
</html>
