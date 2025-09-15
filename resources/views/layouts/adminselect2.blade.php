<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
        <meta name="description" content="Smarthr - Bootstrap Admin Template">
		<meta name="keywords" content="admin, estimates, bootstrap, business, corporate, creative, management, minimal, modern, accounts, invoice, html5, responsive, CRM, Projects">
        <meta name="author" content="Dreamguys - Bootstrap Admin Template">
        <meta name="robots" content="noindex, nofollow">
        <title>Dashboard - NMCH</title>

		<!-- Favicon -->
        <link rel="shortcut icon" type="image/x-icon" href="{{asset('assets/img/favicon.jpg')}}">

		<!-- Bootstrap CSS -->
        <link rel="stylesheet" href="{{asset('assets/css/bootstrap.min.css')}}">

		<!-- Fontawesome CSS -->
        <link rel="stylesheet" href="{{asset('assets/css/font-awesome.min.css')}}">

		<!-- Lineawesome CSS -->
        <link rel="stylesheet" href="{{asset('assets/css/line-awesome.min.css')}}">

		<!-- Chart CSS -->
		<link rel="stylesheet" href="{{asset('assets/plugins/morris/morris.css')}}">
 <!-- Datatable -->
 <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
 <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.2/css/buttons.dataTables.min.css">
		<!-- Main CSS -->
        <link rel="stylesheet" href="{{asset('assets/css/style.css')}}">
         <!-- Select2 CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
        @livewireStyles
        @stack('page-css')
    </head>

    <body>
		<!-- Main Wrapper -->
        <div class="main-wrapper">

			<!-- Header -->
            @include('partials.navigation')
			<!-- /Header -->

			<!-- Sidebar -->
            @include('partials.sidebar')
			<!-- /Sidebar -->

			<!-- Page Wrapper -->
            <div class="page-wrapper">

				<!-- Page Content -->
                <div class="content container-fluid">
                    @if(Session::has('message'))
                    <div class="alert alert-success alert-dismissible">

                        {{Session::get('message')}}
                        </div>
                    @endif
                    @yield('content')
                </div>
				<!-- /Page Content -->

            </div>
			<!-- /Page Wrapper -->

        </div>
		<!-- /Main Wrapper -->

		<!-- jQuery -->
        <script src="{{asset('assets/js/jquery-3.5.1.min.js')}}"></script>

		<!-- Bootstrap Core JS -->
        <script src="{{asset('assets/js/popper.min.js')}}"></script>
        <script src="{{asset('assets/js/bootstrap.min.js')}}"></script>

		<!-- Slimscroll JS -->
		<script src="{{asset('assets/js/jquery.slimscroll.min.js')}}"></script>

		<!-- Chart JS -->
		<script src="{{asset('assets/plugins/morris/morris.min.js')}}"></script>
		<script src="{{asset('assets/plugins/raphael/raphael.min.js')}}"></script>
		<script src="{{asset('assets/js/chart.js')}}"></script>
  <!-- Datatable JS -->
  <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
  <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.print.min.js"></script>
		<!-- Custom JS -->
		<script src="{{asset('assets/js/app.js')}}"></script>
        {{-- disabling submit on enter key press --}}
        <script>
            $('form input').on('keypress', function(e) {
              //  alert('form not submited')
             return e.which !== 13;
        });
            </script>
  <!-- jQuery -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <!-- Select2 -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
  <script>
    $(".select2").select2({
        placeholder: "Select",
        //allowClear: true
    });
    $("#multiple").select2({
        placeholder: "Select a programming language",
        allowClear: true
    });
  </script>
        @livewireScripts
        @stack('page-script')
    </body>
</html>
