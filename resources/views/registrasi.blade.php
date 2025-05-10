<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Login</title>


        <meta name="csrf-token" content="{{ csrf_token() }}">

        <!-- Google Font: Source Sans Pro -->
        <link rel="stylesheet"
            href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">

        <!-- Font Awesome Icons -->
        <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css')}}">
        <!-- Theme style -->
        <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css')}}">

    </head>

    <body class="register-page">
        <div class="register-box">
            <div class="register-logo">
            <p>
                UD Toko Diva Mowewe
            </p>
            </div>

            <div class="card">
                <div class="card-body register-card-body">

                    <p class="register-box-msg">
                        Sudah punya akun, silahkan <a href="{{ route('login')}}">Login</a>
                    </p>

                    <form action="{{ route('signup') }}"  method="post">
                    @csrf

                        <div class="form-group">
                            <label for="role">Daftar Sebagai</label>
                        <div class="input-group mb-3">
                            <!-- <input type="text" class="form-control" placeholder="Nama Anda" name="name"> -->
                            <select name="role" id="role" class="form-control">
                                <option value="{{ \App\Constants\Role::RESELLER}}">Reseller</option>
                                <option value="{{ \App\Constants\Role::KURIR}}">Kurir</option>
                            </select>

                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-vector-square"></span>
                                </div>
                            </div>

                        </div>
                        </div>

                        <div class="input-group mb-3">
                            <input type="text" class="form-control" placeholder="Nama Anda" name="name">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-user"></span>
                                </div>
                            </div>
                        </div>

                        <div class="input-group mb-3">
                            <input type="email" class="form-control" placeholder="Email" name="email">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-envelope"></span>
                                </div>
                            </div>
                        </div>

                        <div class="input-group mb-3">
                            <input type="phone" class="form-control" placeholder="Nomor Telephone" name="phone">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-phone"></span>
                                </div>
                            </div>
                        </div>

                        <div class="input-group mb-3">
                            <input type="password" class="form-control" placeholder="Password" name="password">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-lock"></span>
                                </div>
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <input type="password" class="form-control" placeholder="Ulangi Password" name="password_confirmation">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-lock"></span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-8">
                            </div>
                            <!-- /.col -->
                            <div class="col-4">
                                <button type="submit" class="btn btn-primary btn-block">Daftar</button>
                            </div>
                            <!-- /.col -->
                        </div>
                    </form>

                </div>
                <!-- /.form-box -->
            </div><!-- /.card -->
        </div>

        <!-- REQUIRED SCRIPTS -->

        <!-- jQuery -->
        <script src="{{ asset('plugins/jquery/jquery.min.js')}}"></script>
        <!-- Bootstrap 4 -->
        <script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
        <!-- AdminLTE App -->
        <script src="{{ asset('dist/js/adminlte.min.js')}}"></script>


    </body>

</html>

@section('content')
