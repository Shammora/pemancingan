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
                <h5 class="modal-title" id="searchModalLabel">Proses Pencarian</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="searchProcess"></div>


                <div id="pemancinganArray" style="margin-top: 20px;">
                    <strong>Pemancingan Array:</strong>
                    <pre>
[
@foreach($data as $pemancingan)
    {
        "nama": "{{ $pemancingan['nama'] }}",
        "status": "{{ $pemancingan['status'] }}"
    },
@endforeach
]
</pre>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
@endsection

@section('javascript')
<script>
    $(document).ready(function () {
        $('#searchModal').modal('show');
        var startTime = new Date().getTime();

        // Ambil waktu pencarian dari localstorage jika ada, jiak tidak buat array baru
        var searchTimes = JSON.parse(localStorage.getItem('searchTimes')) || [];

        var searchProcess = @json($searchProcess);

        function displayStepByStep(i) {
            if (i < searchProcess.length) {
                setTimeout(function () {
                    var stepInfo = searchProcess[i];
                    var stepText =
                        "Tahap ke " + stepInfo.step + ": " + stepInfo.comparison +
                        (stepInfo.found ? " - Sesuai." : " - Tidak sesuai.");

                    $('#searchProcess').append(stepText + "<br>");

                    displayStepByStep(i + 1);

                    if (i === searchProcess.length - 1) {
                        var endTime = new Date().getTime();
                        var processTime = endTime - startTime;

                        // Simpan waktu pencarian ke local storage
                        searchTimes.push(processTime);
                        localStorage.setItem('searchTimes', JSON.stringify(searchTimes));

                        // Hitung waktu maksimal, minimal, rata2
                        var maxTime = Math.max(...searchTimes);
                        var minTime = Math.min(...searchTimes);
                        var averageTime = searchTimes.reduce((acc, time) => acc + time, 0) / searchTimes.length;
                        $('#searchProcess').append("<br>Waktu Pencarian:");
                        $('#searchProcess').append("<br>tMax: " + maxTime / 1000 + " detik");
                        $('#searchProcess').append("<br>tMin: " + minTime / 1000 + " detik");
                        $('#searchProcess').append("<br>tAvg: " + averageTime.toFixed(2) / 1000 + " detik");
                    }
                }, 500);
            }
        }

        // Menampilkan proses pencarian
        displayStepByStep(0);
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