@extends('layouts.admin')
@section('css')
<link rel="stylesheet" href="{{ asset('adminlte/plugins/datatables/dataTables.bootstrap.css') }}">
<style>
    img.zoom {
        width: 130px;
        height: 100px;
        -webkit-transition: all .2s ease-in-out;
        -moz-transition: all .2s ease-in-out;
        -o-transition: all .2s ease-in-out;
        -ms-transition: all .2s ease-in-out;
    }

    .transisi {
        -webkit-transform: scale(1.8);
        -moz-transform: scale(1.8);
        -o-transform: scale(1.8);
        transform: scale(1.8);
    }
</style>
@endsection

@section('content')
<section class="content-header">
    <ol class="breadcrumb">
        <li><a href="{{ route('admin.index') }}"><i class="fa fa-home"></i> Home</a></li>
        <li class="active">Data Pemancingan</li>
    </ol>
    <br />
</section>
<section class="content">
    @if (\Session::has('msg_success'))
    <h5>
        <div class="alert alert-info">
            {{ \Session::get('msg_success') }}
        </div>
    </h5>
    @endif
    @if (\Session::has('msg_error'))
    <h5>
        <div class="alert alert-danger">
            {{ \Session::get('msg_error') }}
        </div>
    </h5>
    @endif
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-danger">
                <div class="box-header">
                    <h3 class="box-title">Data Pemancingan</h3>
                </div>
                <div class="box-body table-responsive">
                    <table class="table table-bordered table-striped" id="data-pemancing">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Gambar</th>
                                <th>Nama</th>
                                <th>Deskripsi</th>
                                <th>Alamat</th>
                                <th>Link Map</th>
                                <th>No Telpon</th>
                                <th>Fasilitas</th>
                                <th>Umpan</th>
                                <th>Pemilik</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach (@$pemancingan as $key => $value)
                            <tr>
                                <td>{{ @$value->id }}</td>
                                <td><img class="zoom" src="{{ @$value->gambar }}"></td>
                                <td>{{ @$value->nama }}</td>
                                <td>{{ @$value->deskripsi }}</td>
                                <td>{{ @$value->alamat }}</td>
                                <td>{{ @$value->link_map }}</td>
                                <td>{{ @$value->telpon }}</td>
                                <td>{{ @$value->fasilitas }}</td>
                                <td>{{ @$value->umpan }}</td>
                                <td>{{ @$value->Pemilik->name }}</td>
                                <td>{{ @$value->status }}</td>
                                <td>
                                    @if ($value->status == 'Menunggu')
                                    <a href="{{ route('admin.setuju', $value->id) }}"><button
                                            class=" btn btn-xs btn-primary"
                                            onclick="return confirm('Apakah anda ingin menyetui data ini ?')"><i
                                                class="fa fa-check"> Setuju</i></button></a>
                                    <a href="{{ route('admin.tolak', $value->id) }}"><button
                                            class=" btn btn-xs btn-warning"
                                            onclick="return confirm('Apakah anda ingin menolak data ini ?')"><i
                                                class="fa fa-remove"> Tolak</i></button></a>
                                    @endif
                                    <a href="{{ route('admin.deletePemancingan', $value->id) }}"><button
                                            class=" btn btn-xs btn-danger"
                                            onclick="return confirm('Apakah anda ingin menghapus data ini ?')"><i
                                                class="fa fa-trash"> Hapus</i></button></a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('javascript')
<script src="{{ asset('adminlte/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('adminlte/plugins/datatables/dataTables.bootstrap.min.js') }}"></script>
<script type="text/javascript">
    var table = $('#data-pemancing').DataTable();

    $('#data-pemancing').on('click', '.btn-edit-pemancing', function () {
        row = table.row($(this).closest('tr')).data();
        console.log(row);
        $('input[name=id]').val(row[0]);
        $('input[name=name]').val(row[2]);
        $('input[name=email]').val(row[3]);
        $('input[name=username]').val(row[4])
        $('input[name=no_hp]').val(row[5])
        $('#modal-form-edit-pemancing').modal('show');
    });
    $('#modal-form-tambah-pemancing').on('show.bs.modal', function () {
        $('input[name=id]').val('');
        $('input[name=name]').val('');
        $('input[name=email]').val('');
        $('input[name=username]').val('');
        $('input[name=no_hp]').val('');
    });

    $(document).ready(function () {
        $('.zoom').hover(function () {
            $(this).addClass('transisi');
        }, function () {
            $(this).removeClass('transisi');
        });
    });
</script>
@endsection