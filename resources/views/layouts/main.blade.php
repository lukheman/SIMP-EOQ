<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ Auth::user()->role }} | {{ Auth::user()->name }}</title>


    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">

    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}">

    <!-- Select2 -->
    <link rel="stylesheet" src="{{ asset('plugins/select2/css/select2.min.css') }}"></link>

    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css')}}">
    <!-- ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css')}}">

        <style>
        .product-image {
            width: 180px; /* Set desired width */
            height: 180px; /* Set desired height */
            object-fit: cover; /* Ensures images scale and crop nicely */
            display: block;
            /* margin: 0 auto; /* Center the image */ */
        }
</style>

</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">

        <!-- Navbar -->
        @include('layouts.navbar')
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        @include('layouts.sidebar')

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">{{ $page }}</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a
                                        href="{{ route(str_replace('_', '', Auth::user()->role) . '.' . 'dashboard')}}">Home</a>
                                </li>
                                <li class="breadcrumb-item active">{{ $page }}</li>
                            </ol>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <div class="content">
                <div class="container-fluid">
                    @yield('content')
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
            <div class="p-3">
                <h5>Title</h5>
                <p>Sidebar content</p>
            </div>
        </aside>
        <!-- /.control-sidebar -->

        <!-- Main Footer -->
        <footer class="main-footer">
            <!-- <!-- To the right -->
            <!-- <div class="float-right d-none d-sm-inline"> -->
            <!--     Anything you want -->
            <!-- </div> -->
            <!-- <!-- Default to the left -->
            <!-- <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights -->
            <!-- reserved. -->
        </footer>
    </div>
    <!-- ./wrapper -->

    <!-- REQUIRED SCRIPTS -->

    <script>

        function formatRupiah(angka) {
            return new Intl.NumberFormat('id-ID', {style: 'currency', currency: 'IDR'}).format(angka);
        }

    </script>

    <!-- Sweetalert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- jQuery -->
    <script src="{{ asset('plugins/jquery/jquery.min.js')}}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('dist/js/adminlte.min.js')}}"></script>

    <!-- DataTables  & Plugins -->
    <script src="{{ asset('plugins/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{ asset('plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{ asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/dataTables.buttons.min.js')}}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/buttons.bootstrap4.min.js')}}"></script>

    <!-- <script src="{{ asset('plugins/jszip/jszip.min.js')}}"></script> -->
    <!-- <script src="{{ asset('plugins/pdfmake/pdfmake.min.js')}}"></script> -->
    <!-- <script src="{{ asset('plugins/pdfmake/vfs_fonts.js')}}"></script> -->
    <script src="{{ asset('plugins/datatables-buttons/js/buttons.html5.min.js')}}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/buttons.print.min.js')}}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/buttons.colVis.min.js')}}"></script>

    <!-- Select2 -->
    <script src="{{ asset('plugins/select2/js/select2.full.min.js') }}"></script>

    <script>

        function formatRupiah(angka) {
            return new Intl.NumberFormat('id-ID', {style: 'currency', currency: 'IDR'}).format(angka);
        }

        function swalToast(title, icon = 'success') {

            Swal.fire({
                toast: true,
                position: 'top-end',
                icon: icon,
                title: title,
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer);
                    toast.addEventListener('mouseleave', Swal.resumeTimer);
                }
            });


        }

        const showToast = (title, icon = 'success', reload=true) => {

            // Reload halaman
            if(reload) {
                // Simpan status bahwa halaman akan di-reload
                sessionStorage.setItem('reload', 'true');
                sessionStorage.setItem('icon', icon);
                sessionStorage.setItem('title', title);

                window.location.reload();
            } else  {

                swalToast(title, icon);

            }
        };

        // Setelah halaman dimuat ulang, periksa apakah reload terjadi
        $(window).on('load', function() {
            if (sessionStorage.getItem('reload') === 'true') {
                title = sessionStorage.getItem('title');
                icon = sessionStorage.getItem('icon');
                // Tampilkan toast
                swalToast(title, icon);

                // Hapus item setelah toast ditampilkan
                sessionStorage.removeItem('reload');
            }
        });
        </script>

    @yield('custom-script')

</body>

</html>
