@extends('layouts.pemancing')

@section('css')
<!-- Add your CSS styles here -->
<style>
    .newBackground {
        background-image: url('images/cover_cargo.png');
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        height: 580px;
        width: 100%;
    }

    .newBackground::before {
        content: "";
        display: block;
        position: absolute;
        top: 0;
        left: 0;
        height: 655px;
        width: 100%;
        background-color: rgba(0, 0, 0, 0.5);
    }

    .content {
        position: absolute;
        top: 35%;
        left: 20%;
        transform: translate(-50%, -50%);
        color: white;
        font-size: 4vw;
        font-weight: bold;
        text-align: center;
    }

    @media (max-width: 768px) {
        .container {
            flex-direction: column;
        }

        .newBackground,
        .content {
            width: 100%;
            left: 50%;
        }

        .newBackground::before {
            height: 655px;
        }
    }

    @media (max-width: 480px) {
        h1 {
            font-size: 24px;
        }

        p {
            font-size: 16px;
        }
    }

    .content1 {
        width: 80%;
        margin-top: 60px;
        margin-left: 10%;
        margin-bottom: 50px;
    }

    .search {
        width: 80%;
        margin-top: 30px;
        margin-left: 10%;
    }

    /* Add modal styles */
    #searchModal {
        display: none;
    }
</style>
@endsection

@section('content')
<div class="search">
    <form action="{{ route('pemancing.search') }}" method="POST" id="searchForm">
        @csrf
        <div class="row">
            <div class="col-sm-4">
                <input type="text" name="search" class="form-control" placeholder="Cari..">
            </div>
            <div class="col-sm-3">
                <button type="submit" class="btn btn-primary" id="searchButton"><i class="fa fa-search"></i>Cari
                </button>
            </div>
        </div>
    </form>
</div>
@if ($status == 'false')
<p style="margin-top: 20px; margin-left: 10%">Data Tidak Ditemukan <br>
    Status : {{ $status }}
</p>
@else
<p style="margin-top: 20px; margin-left: 10%">Data Ditemukan <br>
    pada Index ke : {{ $hasilIndex }}
    <br>
    Status : {{ $status }}
</p>
<div class="content1">
    <div class="row">
        <div class="col-sm-4" style="margin-top: 10px">
            <div class="card" style="width: 320px; height: 360px">
                <img src="{{ $hasilData->gambar }}" class="card-img-top" style="height: 200px">
                <div class="card-body">
                    <h5 class="card-title">{{ $hasilData->nama }}</h5>
                    <p class="card-text" style="font-size: 12px">{{ substr($hasilData->deskripsi, 0, 50) . '...' }}
                    </p>
                    <a href="{{ route('pemancing.detail', $hasilData->id) }}" class="btn btn-primary">Detail</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endif

<!-- Bootstrap Modal -->
<div class="modal fade" id="searchModal" tabindex="-1" role="dialog" aria-labelledby="searchModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="searchModalLabel">Tahapan Algoritma</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="text-center">
                    <button class="btn btn-primary" id="expandDataLengkap">Tampilkan Data
                        Lengkap</button>
                </div>
                <div id="dataLengkap" style="display: none; margin-top: 10px;">
                    <div class="d-flex justify-content-between">
                        <strong>Data Lengkap:</strong>
                        <button class="btn btn-primary" id="copyDataLengkap">
                            <i class="fas fa-copy"></i> Salin Data
                        </button>
                    </div>
                    <pre id="dataSebenarnya:v">
[
@foreach($data as $pemancingan)
    {
        "id": "{{ $pemancingan['id'] }}",
        "nama": "{{ $pemancingan['nama'] }}",
        "gambar": "{{ $pemancingan['gambar'] }}",
        "deskripsi": "{{ $pemancingan['deskripsi'] }}"
    },
@endforeach
]
</pre>
                </div>
                <div class="text-center">
                    <h1 class="mx-auto">↓</h1>
                </div>
                <div class="text-center">
                    <button class="btn btn-primary" id="expandPemancinganArray">Tampilkan Pemancingan
                        Array</button>
                </div>
                <div id="pemancinganArray" style="display: none; margin-top: 10px;">
                    <strong>Pemancingan Array:</strong>
                    <pre>
@foreach($data as $i => $pemancingan)
    Data array index ke {{ $i }} = {{ $pemancingan['nama'] }}
@endforeach
</pre>
                </div>
                <div class="text-center">
                    <h1 class="mx-auto">↓</h1>
                </div>
                <div>
                    <strong>Proses Pencarian:</strong>
                    <div id="searchProcess"></div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>
@endsection

@section('javascript')
<script>
    document.addEventListener("DOMContentLoaded", function () {
        $('#searchModal').modal('show');

        var startTime = new Date().getTime();
        var searchProcess = @json($searchProcess);
        var kataDicariDisplayed = false;

        function toggleSection(sectionId) {
            var section = document.getElementById(sectionId);
            if (section.style.display === "none" || section.style.display === "") {
                section.style.display = "block";
            } else {
                section.style.display = "none";
            }
        }

        document.getElementById('expandDataLengkap').addEventListener('click', function () {
            toggleSection('dataLengkap');
        });

        document.getElementById('expandPemancinganArray').addEventListener('click', function () {
            toggleSection('pemancinganArray');
        });

        function displayStepByStep(i) {
            if (i < searchProcess.length) {
                setTimeout(function () {
                    var stepInfo = searchProcess[i];
                    var stepText =
                        "<br />Tahap ke " + stepInfo.step + ": <br />" + stepInfo.comparison +
                        (stepInfo.found ? "<br />(<span class='text-success'>Sesuai</span>)" : "<br />(<span class='text-danger'>Tidak Sesuai</span>)");

                    if (!kataDicariDisplayed) {
                        $('#searchProcess').append("Kata yang dicari: <span class='text-primary'>" + stepInfo.search + "</span><br />");
                        kataDicariDisplayed = true;
                    }

                    $('#searchProcess').append(stepText + "<br>");

                    displayStepByStep(i + 1);

                    if (i === searchProcess.length - 1) {
                        var endTime = new Date().getTime();
                        var processTime = endTime - startTime;

                        // Hitung waktu maksimal, minimal, rata2
                        $('#searchProcess').append("<br>Waktu Pencarian: " + processTime / 1000 + " detik");
                    }
                }, 500);
            }
        }

        // Menampilkan proses pencarian
        displayStepByStep(0);
    });

    document.getElementById('copyDataLengkap').addEventListener('click', function () {
        var dataLengkapText = document.getElementById('dataSebenarnya:v').innerText;

        navigator.clipboard.writeText(dataLengkapText).then(function () {
            alert('Data berhasil disalin!');
        }).catch(function (err) {
            console.error('Data gagal disalin!', err);
        });
    });

    $('#searchForm').on('keyup keypress', function (e) {
        var keyCode = e.keyCode || e.which;
        if (keyCode === 13) {
            e.prt();
            return false;
        }
    });
</script>
@endsection