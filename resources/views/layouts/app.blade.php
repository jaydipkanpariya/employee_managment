<!DOCTYPE html>
<html lang="en">

    <head>
        <title>Highsense Report</title>
        <!-- HTML5 Shim and Respond.js IE11 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 11]>
    	<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    	<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    	<![endif]-->
    <!-- Meta -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="description" content="" />
    <meta name="keywords" content="">
    <meta name="author" content="Phoenixcoded" />
    <!-- Favicon icon -->
    <link rel="icon" href="assets/images/favicon.ico" type="image/x-icon">

    <!-- vendor css -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css')}}">

    <style>
        .error {
            color: red;
        }
    </style>

</head>

<body class="">
    <!-- [ Pre-loader ] start -->
    <div class="loader-bg">
        <div class="loader-track">
            <div class="loader-fill"></div>
        </div>
    </div>
    <!-- [ Pre-loader ] End -->
    @include('layouts.partials.sidebar')
    @include('layouts.partials.topbar')


    @yield('content')
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

    <!-- Required Js -->
    <script src="{{ asset('assets/js/vendor-all.min.js')}}"></script>
    <script src="{{ asset('assets/js/plugins/bootstrap.min.js')}}"></script>
    <script src="{{ asset('assets/js/pcoded.min.js')}}"></script>

    <!-- Apex Chart -->
    <!-- <script src="{{ asset('assets/js/plugins/apexcharts.min.js')}}"></script> -->


    <!-- custom-chart js -->
    <!-- <script src="{{ asset('assets/js/pages/dashboard-main.js')}}"></script> -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.20.0/jquery.validate.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.3.0/jquery.form.min.js"></script>
    <!-- Include SweetAlert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

    <!-- Your custom script -->
    <script>
        function notify(msg, type = "success") {
            Swal.fire({
                icon: type,
                title: msg,
                timer: (type == "success") ? 1000 : 2000
            });
        }
    </script>

    <script>
        function notify(msg, type = "success") {
            alert(1);
            Swal.fire({
                icon: type,
                title: msg,
                timer: (type == "success") ? 1000 : 2000
            })
        }
    </script>
    @yield('scripts')
</body>

</html>
