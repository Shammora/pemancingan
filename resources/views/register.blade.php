<!DOCTYPE html>
<html>

<head>
    <link rel="shortcut icon" href="trustme.png" type="image/x-icon" />
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Selamat Datang</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="stylesheet" href="{{ asset('adminlte/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('adminlte/dist/css/AdminLTE.min.css') }}">
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/iCheck/square/blue.css') }}">
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/morris/morris.css') }}">
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/font-awesome/css/font-awesome.min.css') }}">
</head>

<body class="hold-transition login-page">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <br />
                <div class="login-logo">
                    <b>Aplikasi</b> <br>Pemancingan
                    {{-- {{ bcrypt('password') }} --}}
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="login-box">
                    <div class="login-box-body">
                        <h3 class="login-box-msg">Pemancingan </h3>
                        @if (\Session::has('msg_login'))
                            <div class="alert alert-danger">
                                {{ \Session::get('msg_login') }}
                            </div>
                        @endif
                        @if (\Session::has('msg_success'))
                            <div class="alert alert-success">
                                {{ \Session::get('msg_success') }}
                            </div>
                        @endif
                        <p class="login-box-msg">Register </p>
                        <form action="{{ route('prosesRegister') }}" method="POST" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="form-group has-feedback">
                                <input type="text" name="name" class="form-control" placeholder="Nama Lengkap"
                                    value="{{ old('name') }}" required>
                                <span class="glyphicon glyphicon-user form-control-feedback"></span>
                            </div>
                            <div class="form-group has-feedback">
                                <label>Foto Profile :</label>
                                <input type="file" name="foto" class="form-control" placeholder="Foto Profile"
                                    required>
                                <span class="glyphicon glyphicon-picture form-control-feedback"></span>
                            </div>
                            <div class="form-group has-feedback">
                                <input type="email" name="email" class="form-control" placeholder="Email"
                                    value="{{ old('email') }}" required>
                                <span class="glyphicon glyphicon-asterisk form-control-feedback"></span>
                            </div>
                            <div class="form-group has-feedback">
                                <input type="number" name="no_hp" class="form-control" placeholder="Nomor HP"
                                    value="{{ old('no_hp') }}" required>
                                <span class="glyphicon glyphicon-phone form-control-feedback"></span>
                            </div>
                            <div class="form-group has-feedback">
                                <input type="text" name="username" class="form-control" placeholder="Username"
                                    value="{{ old('username') }}" required>
                                <span class="glyphicon glyphicon-user form-control-feedback"></span>
                            </div>
                            <div class="form-group has-feedback">
                                <input type="password" name="password" class="form-control" placeholder="Password"
                                    required>
                                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <button type="submit" class="btn btn-danger btn-block btn-flat">Register</button>
                                </div>
                            </div>
                            <br>
                            <center>
                                <p>Sudah memiliki akun? <a href="{{ route('login') }}">Login</a></p>
                            </center>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('adminlte/plugins/jQuery/jquery-2.2.3.min.js') }}"></script>
    <script src="{{ asset('adminlte/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('adminlte/plugins/iCheck/icheck.min.js') }}"></script>
    <script src="{{ asset('adminlte/plugins/morris/morris.min.js') }}"></script>
    <script src="{{ asset('adminlte/plugins/raphael/raphael-min.js') }}"></script>
    <script>
        $(function() {
            $('input').iCheck({
                checkboxClass: 'icheckbox_square-blue',
                radioClass: 'iradio_square-blue',
                increaseArea: '20%'
            });
        });
    </script>
</body>

</html>
