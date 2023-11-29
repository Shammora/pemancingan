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
        <p style="justify-content: left">Lorem ipsum dolor, sit amet
            consectetur adipisicing elit. Vitae, quis? Ullam
            nostrum nihil voluptas optio
            repudiandae, itaque quas earum cumque nemo dignissimos rerum provident placeat. Vero impedit provident
            cumque praesentium. Lorem ipsum dolor sit amet consectetur adipisicing elit. Totam, maxime quo quia
            repudiandae repellendus voluptatum consectetur est autem doloremque repellat ipsum fuga quasi praesentium
            corporis aliquid delectus officia perspiciatis voluptatibus.</p>
    </div>
    <div class="content1">
        <h2 class="text-dark">Apa itu algoritma sequencial search?</h2>
        <br>
        <p style="justify-content: left">Lorem ipsum dolor, sit amet
            consectetur adipisicing elit. Vitae, quis? Ullam
            nostrum nihil voluptas optio
            repudiandae, itaque quas earum cumque nemo dignissimos rerum provident placeat. Vero impedit provident
            cumque praesentium. Lorem ipsum dolor sit amet consectetur adipisicing elit. Totam, maxime quo quia
            repudiandae repellendus voluptatum consectetur est autem doloremque repellat ipsum fuga quasi praesentium
            corporis aliquid delectus officia perspiciatis voluptatibus.</p>
    </div>
    <div class="content1">
        <h2 class="text-dark">Lorem Ipsum dolor</h2>
        <br>
        <p style="justify-content: left">Lorem ipsum dolor, sit amet
            consectetur adipisicing elit. Vitae, quis? Ullam
            nostrum nihil voluptas optio
            repudiandae, itaque quas earum cumque nemo dignissimos rerum provident placeat. Vero impedit provident
            cumque praesentium. Lorem ipsum dolor sit amet consectetur adipisicing elit. Totam, maxime quo quia
            repudiandae repellendus voluptatum consectetur est autem doloremque repellat ipsum fuga quasi praesentium
            corporis aliquid delectus officia perspiciatis voluptatibus.</p>
    </div>
@endsection

@section('javascript')
@endsection
