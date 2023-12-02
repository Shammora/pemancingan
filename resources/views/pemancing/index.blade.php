@extends('layouts.pemancing')
@section('css')
    <style>
        .newBackground {
            background-image: url('/assets/logoMancing.jpg');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            height: 655px;
            width: 100%;
        }

        .content {
            background-color: #3156A5;
            color: white;
            padding: 20px;
            width: 40%;
            height: 85%;
            box-sizing: border-box;
        }

        @media (max-width: 768px) {
            .container {
                flex-direction: column;
            }

            .newBackground,
            .content {
                width: 100%;
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
    <div class="newBackground">
        <div class="col-lg-6 p-5 wow fadeIn content" data-wow-delay="0.1s">
            <br>
            <br>
            <h1 class="display-4 text-white mt-5">Stay Calm <br> Stay Fishing</h1>
            <p class="text-white">"Beri seseorang ikan dan Anda memberinya makan selama sehari. Ajari seseorang untuk
                memancing dan Anda memberinya makan seumur hidup." - Anne Ritchie</p>
            <br>
            <br>
            <a class="btn btn-primary border-white px-4" href="{{ route('pemancing.pemancingan') }}"
                style="height: 40px">Pemancingan</a>
        </div>
    </div>
@endsection

@section('javascript')
@endsection
