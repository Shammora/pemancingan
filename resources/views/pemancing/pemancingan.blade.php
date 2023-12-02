@extends('layouts.pemancing')
@section('css')
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
</style>
@endsection
@section('content')
<div class="search">
    <form action="{{ route('pemancing.search') }}" method="POST">
        @csrf
        <div class="row">
            <div class="col-sm-4">
                <input type="text" name="search" class="form-control" placeholder="Cari..">
            </div>
            <div class="col-sm-3">
                <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i>Cari</button>
            </div>
        </div>
    </form>
</div>
<div class="content1">
    <div class="row">
        @foreach ($data as $key => $value)
        <div class="col-sm-4" style="margin-top: 10px">
            <div class="card" style="width: 320px; height: 360px">
                <img src="{{ $value->gambar }}" class="card-img-top" style="height: 200px">
                <div class="card-body">
                    <h5 class="card-title">{{ $value->nama }}</h5>
                    <p class="card-text" style="font-size: 12px">{{ substr($value->deskripsi, 0, 50) . '...' }}</p>
                    <a href="{{ route('pemancing.detail', $value->id) }}" class="btn btn-primary">Detail</a>
                </div>
            </div>
        </div>
        {!! ($key + 1) % 3 == 0 ? '
    </div>
    <div class="row">' : '' !!}
        @endforeach
    </div>
</div>
@endsection

@section('javascript')
@endsection