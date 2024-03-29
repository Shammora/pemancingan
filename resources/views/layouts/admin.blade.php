<!DOCTYPE html>
<html>

<head>
    <link rel="shortcut icon" href="#" type="image/x-icon" />
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>{{ $title }}</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="stylesheet" type="text/css" href="{{ asset('adminlte/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/font-awesome/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/ionslider/ion.rangeSlider.min.js') }}">
    <link rel="stylesheet" href="{{ asset('adminlte/dist/css/AdminLTE.min.css') }}">
    <link rel="stylesheet" href="{{ asset('adminlte/dist/css/skins/_all-skins.min.css') }}">
    @yield('css')
</head>

<style>
    .umpetin {
        display: none;
    }
</style>

<body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">

        <header class="main-header">
            <a href="/admin/home" class="logo">
                <span class="logo-mini"><b>ADMIN</b></span>
                <span class="logo-lg"><b>Administrator</b></span>
            </a>
            <nav class="navbar navbar-static-top">
                <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                    <span class="sr-only">Navigation</span>
                </a>
            </nav>
        </header>
        <aside class="main-sidebar">
            <section class="sidebar">
                <ul class="sidebar-menu">
                    <li>
                        <a href="{{ route('admin.index') }}">
                            <i class="fa fa-home"></i> <span>Home</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.dataPemancing') }}">
                            <i class="fa fa-list-alt"></i> <span>Data Pemancing</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.dataPemilik') }}">
                            <i class="fa fa-list-alt"></i> <span>Data Pemilik Pemancingan</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.dataPemancingan') }}">
                            <i class="fa fa-list-alt"></i> <span>Data Pemancingan</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.profile') }}">
                            <i class="fa fa-wrench"></i> <span>Profile</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('logout') }}">
                            <i class="fa fa-sign-out"></i> <span>Logout</span>
                        </a>
                    </li>
                    <li class="umpetin">
                        <a href="#" id="showDataModal">
                            <i class="fa fa-copy"></i> <span>Apa nich</span>
                        </a>
                    </li>
                </ul>
            </section>
        </aside>
        <div class="content-wrapper">
            @yield('content')
        </div>

        <div class="modal fade" id="dataModal" tabindex="-1" role="dialog" aria-labelledby="dataModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title" id="dataModalLabel">Waduch Apa Nich</h3>
                    </div>
                    <div class="modal-body">
                        <div>
                            <button class="btn btn-primary" id="copyDataLengkap">
                                <i class="fa fa-copy"></i> Salin Data
                            </button>
                            <button class="btn btn-primary" id="showData">
                                <i></i> Tampilkan Data
                            </button>
                        </div>
                        <div id="dataMentah" class="mt-4" style="display: none; margin-top: 10px;">
                            <pre>
[
@php
    $pemancinganExists = isset($pemancingan);
@endphp

@if($pemancinganExists)
@foreach($pemancingan as $key => $value)
{
    "id": "{{ $value->id }}",
    "nama": "{{ $value->nama }}",
    "gambar": "{{ $value->gambar }}",
    "deskripsi": "{{ $value->deskripsi }}"
}{{ !$loop->last ? ',' : '' }}
@endforeach
@php
$pemancinganCount = count($pemancingan);
@endphp
@endif

]
    </pre>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <footer class="main-footer">
            <div class="pull-right hidden-xs">
                <b>Build with <span class="fa fa-coffee"></span> And <span id="heartIcon" class="fa fa-heart"></b>
            </div>
            <strong>Copyright &copy; 2023 .</strong>
        </footer>
        <div class="control-sidebar-bg"></div>
    </div>
    <script src="{{ asset('adminlte/plugins/jQuery/jquery-2.2.3.min.js') }}"></script>
    <script src="{{ asset('adminlte/plugins/jQueryUI/jquery-ui.min.js') }}"></script>
    <script>
        $.widget.bridge('uibutton', $.ui.button);

        function toggleSection(sectionId) {
            var section = document.getElementById(sectionId);
            if (section.style.display === 'none') {
                section.style.display = 'block';
            } else {
                section.style.display = 'none';
            }
        }

        // Bug fix, pastikan $pemancingan ada
        var pemancinganCount = {{ $pemancinganCount ?? 0 }}

        $(document).ready(function () {
            $('#heartIcon').on('click', function () {
                if (pemancinganCount > 0) {
                    console.log(pemancinganCount);
                    $('.umpetin').toggle();
                }
            });

            $('#showDataModal').on('click', function () {
                $('#dataModal').modal('show');
            });

            document.getElementById('showData').addEventListener('click', function () {
                toggleSection('dataMentah');
            });
        });

        document.getElementById('copyDataLengkap').addEventListener('click', function () {
            var dataLengkapText = document.getElementById('dataMentah').innerText;

            navigator.clipboard.writeText(dataLengkapText).then(function () {
                alert('Data berhasil disalin!');
            }).catch(function (err) {
                console.error('Data gagal disalin!', err);
            });
        });

    </script>
    <script src="{{ asset('adminlte/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('adminlte/plugins/slimScroll/jquery.slimscroll.min.js') }}"></script>
    <script src="{{ asset('adminlte/plugins/fastclick/fastclick.js') }}"></script>
    <script src="{{ asset('adminlte/dist/js/app.min.js') }}"></script>
    <script src="{{ asset('adminlte/dist/js/demo.js') }}"></script>
    @yield('javascript')
</body>

</html>