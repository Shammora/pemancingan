@extends('layouts.pemancingan')
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
        <li><a href="{{ route('pemancingan.index') }}"><i class="fa fa-home"></i> Home</a></li>
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
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-info btn-xs" data-toggle="modal"
                            data-target="#modal-form-tambah-pemancing"><i class="fa fa-plus"> Tambah Data
                            </i></button>
                    </div>
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
                                <th>Embed Map</th>
                                <th>Link Map</th>
                                <th>Telpon</th>
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
                                <td>{!! @$value->link_map !!}</td>
                                <td>{{ @$value->link_map_2 }}</td>
                                <td>{{ @$value->telpon }}</td>
                                <td>{{ @$value->fasilitas }}</td>
                                <td>{{ @$value->umpan }}</td>
                                <td>{{ @$value->Pemilik->name }}</td>
                                <td>{{ @$value->status }}</td>
                                <td>
                                    <button class="btn btn-xs btn-success btn-edit-pemancing"><i class="fa fa-edit">
                                            Ubah</i></button> &nbsp;
                                    <a href="{{ route('pemancingan.deletePemancingan', $value->id) }}"><button
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
<div class="modal fade" id="modal-form-tambah-pemancing" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Form Tambah Data Pemancingan</h4>
            </div>
            <div class="modal-body">
                <form action="{{ route('pemancingan.addPemancingan') }}" method="post" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="form-group has-feedback">
                        <label>Nama Tempat:</label>
                        <input type="text" name="nama" class="form-control" placeholder="Nama" required>
                    </div>
                    <div class="form-group has-feedback">
                        <label>Deskripsi :</label>
                        <textarea name="deskripsi" id="deskripsi" class="form-control" cols="4" rows="2"
                            required></textarea>
                    </div>
                    <div class="form-group has-feedback">
                        <label>Alamat :</label>
                        <textarea name="alamat" id="alamat" class="form-control" cols="4" rows="2" required></textarea>
                    </div>
                    <div class="form-group has-feedback">
                        <label>Embed Map :</label>
                        <textarea name="embed" id="embed" class="form-control" cols="4" rows="2" required></textarea>
                    </div>
                    <div class="form-group has-feedback">
                        <label>Link Map :</label>
                        <textarea name="link" id="link" class="form-control" cols="4" rows="2" required></textarea>
                    </div>
                    <div class="form-group has-feedback">
                        <label>Telpon :</label>
                        <input type="number" name="telp" class="form-control" placeholder="No Telpon" required>
                    </div>
                    <div class="form-group has-feedback">
                        <label>Fasilitas :</label>
                        <input type="text" name="fasilitas" class="form-control" placeholder="Fasilitas" required>
                    </div>
                    <div class="form-group has-feedback">
                        <label>Umpan :</label>
                        <input type="text" name="umpan" class="form-control" placeholder="Umpan" required>
                    </div>
                    <div class="form-group has-feedback">
                        <label>Gambar Tempat :</label>
                        <input type="file" name="gambar" class="form-control" required>
                    </div>
                    <div class="row">
                        <div class="col-xs-4 col-xs-offset-8">
                            <button type="submit" class="btn btn-primary btn-block btn-flat">Simpan</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modal-form-edit-pemancing" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Form Ubah Data Pemancing</h4>
            </div>
            <div class="modal-body">
                <form action="{{ route('pemancingan.updatePemancingan') }}" method="post" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="form-group has-feedback">
                        <input type="hidden" name="id" readonly class="form-control" placeholder="ID" required>
                    </div>
                    <div class="form-group has-feedback">
                        <label>Nama Tempat:</label>
                        <input type="text" name="nama" class="form-control" placeholder="Nama" required>
                    </div>
                    <div class="form-group has-feedback">
                        <label>Deskripsi :</label>
                        <textarea name="deskripsi" id="deskripsi" class="form-control" cols="4" rows="2"
                            required></textarea>
                    </div>
                    <div class="form-group has-feedback">
                        <label>Alamat :</label>
                        <textarea name="alamat" id="alamat" class="form-control" cols="4" rows="2" required></textarea>
                    </div>
                    <div class="form-group has-feedback">
                        <label>Embed Map :</label>
                        <textarea name="embed" id="embed" class="form-control" cols="4" rows="2" required></textarea>
                    </div>
                    <div class="form-group has-feedback">
                        <label>Link Map :</label>
                        <textarea name="link" id="link" class="form-control" cols="4" rows="2" required></textarea>
                    </div>
                    <div class="form-group has-feedback">
                        <label>Telpon :</label>
                        <input type="number" name="telp" class="form-control" placeholder="No Telpon" required>
                    </div>
                    <div class="form-group has-feedback">
                        <label>Fasilitas :</label>
                        <input type="text" name="fasilitas" class="form-control" placeholder="No HP" required>
                    </div>
                    <div class="form-group has-feedback">
                        <label>Umpan :</label>
                        <input type="text" name="umpan" class="form-control" placeholder="Umpan" required>
                    </div>
                    <div class="form-group has-feedback">
                        <label>Gambar Tempat :</label>
                        <input type="file" name="gambar" class="form-control">
                    </div>
                    <div class="row">
                        <div class="col-xs-4 col-xs-offset-8">
                            <button type="submit" class="btn btn-primary btn-block btn-flat">Simpan</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>
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
        $('input[name=nama]').val(row[2]);
        $('textarea[name=deskripsi]').val(row[3]);
        $('textarea[name=alamat]').val(row[4])
        $('textarea[name=embed]').val(row[5])
        $('textarea[name=link]').val(row[6])
        $('input[name=telp]').val(row[7])
        $('input[name=fasilitas]').val(row[8])
        $('input[name=umpan]').val(row[9])
        $('#modal-form-edit-pemancing').modal('show');
    });
    $('#modal-form-tambah-pemancing').on('show.bs.modal', function () {
        $('input[name=id]').val('');
        $('input[name=nama]').val('');
        $('textarea[name=deskripsi]').val('');
        $('textarea[name=alamat]').val('');
        $('textarea[name=embed]').val('');
        $('textarea[name=link]').val('');
        $('input[name=telp]').val('');
        $('input[name=umpan]').val('');
        $('input[name=fasilitas]').val('');
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