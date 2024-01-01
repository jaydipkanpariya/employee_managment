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
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    @yield('style')
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
    <script src="{{ asset('assets/js/vendor-all.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/pcoded.min.js') }}"></script>
    <script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.4/js/dataTables.bootstrap5.min.js"></script>
    <script type="text/javascript"
        src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.20.0/jquery.validate.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.3.0/jquery.form.min.js">
    </script>
    <!-- Include SweetAlert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

    @if (Auth::guard('employe')->check() && Auth::guard('employe')->user()->note == 1)
        <script>
            $(document).ready(function() {
                if ({{ Auth::guard('employe')->user()->note }} == 1) {
                    Swal.fire({
                        title: 'Here New Notice',
                        text: "You won be able to Read this!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes, Got it!'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            var id = {{ Auth::guard('employe')->user()->id }};
                            $.ajax({
                                url: "{{ url('emp_note') }}/" + id,
                                type: "GET",
                                headers: {
                                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                                },
                                success: function(data) {
                                    console.log(data);

                                }
                            });
                        }
                    });
                }
            });
        </script>
    @endif
    <!-- Your custom script -->
    <script>
        function notify(msg, type = "success") {
            Swal.fire({
                icon: type,
                title: msg,
                timer: (type == "success") ? 1000 : 2000
            });
        }

        $('.dataTable').on('click', '.mytest', function(event) {
            event.preventDefault();
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    var url = $(this).data('url');
                    $.ajax({
                        url: url,
                        type: "DELETE",
                        headers: {
                            'X-CSRF-TOKEN': "{{ csrf_token() }}"
                        },
                        success: function(data) {
                            if (data.status == "success") {
                                Swal.fire(
                                    'Deleted!', 'Your data has been deleted.', 'success'
                                )
                                $('.dataTable').dataTable().api().ajax.reload();
                            } else {
                                notify(data.msg, 'error');
                            }
                        }
                    });
                }
            });
        });
    </script>
    @yield('scripts')
</body>

</html>
