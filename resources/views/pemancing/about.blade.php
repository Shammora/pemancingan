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
        width: 60%;
        margin-top: 50px;
        margin-left: 20%;
        margin-bottom: 50px;
    }

    .content2 {
        width: 80%;
        margin-left: 10%;
        margin-bottom: 50px;
    }

    .cardContent1 {
        width: 60%;
        margin-left: 35%;
        margin-bottom: 10px;
    }

    .cardContent2 {
        width: 60%;
        margin-left: 5%;
        margin-bottom: 10px;
    }

    @media (max-width: 768px) {

        .cardContent1,
        .cardContent2 {
            width: 100%;
            margin-left: 0%;
        }
    }
</style>
@endsection
@section('content')
<div class="content1">
    <h2 class="text-dark">Apa itu pemancingan?</h2>
    <br>
    <p style="justify-content: left">Adalah situs web ulasan pemancingan. Website ini dibuat untuk mempermudah pemancing
        dalam mencari informasi lengkap tentang pemancingan yang ada di Kabupaten Bekasi, dan juga dapat mempermudah
        pihak pemancingan dalam menyebarkan informasi yang ada di pemancingan atau menjadi media promosi pemancingan.
        .</p>
</div>
<div class="content1">
    <h2 class="text-dark">Apa itu algoritma sequencial search?</h2>
    <br>
    <p style="justify-content: left">Algoritma sequential search digunakan untuk metode pencarian pada web ini. Cara
        kerja algoritma pencarian ini dengan cara mengecek setiap elemen array satu persatu secara beruntun hingga
        elemen yang dicari ditemukan atau elemen akhir pada array.</p>
</div>
@endsection

@section('javascript')
@endsection