@extends('layouts.pemancing')
@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
    .card {
        width: 100%;
        max-width: 80%;
        background-color: #ffffff;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        overflow: hidden;
        margin: 10px;
        height: auto;
    }

    .card-image {
        width: 100%;
        height: auto;
    }

    .card-content {
        padding: 20px;
        text-align: center;
    }

    @media screen and (max-width: 768px) {
        .card {
            max-width: 80%;
        }
    }

    .responsive-image {
        width: 20%;
        height: auto;
        margin-top: 50px;
    }

    .right {
        float: right;
    }

    .imageQuote {
        position: relative;
        top: 150px;
        left: 40%;
        transform: translate(-50%, -50%);
        text-align: left;
        color: rgb(46, 10, 173);
        padding: 20px;
        border-radius: 10px;
        width: 100%;
        max-width: 280px;
    }

    .textQuote {
        position: absolute;
        top: 250px;
        left: 65%;
        transform: translate(-50%, -50%);
        text-align: left;
        color: rgb(46, 10, 173);
        padding: 20px;
        border-radius: 10px;
        width: 100%;
        max-width: 400px;
    }

    @media screen and (max-width: 768px) {
        .textQuote {
            width: 100%;
            left: 78%;
            top: 20%;
        }

        .imageQuote {
            width: 65%;
            left: 50%;
            margin-bottom: 15px;
        }
    }

    .confirmCancel {
        margin-left: 9%;
    }

    .contactCard {
        height: 100%;
    }

    @media screen and (max-width: 768px) {
        .contactCard {
            height: 100%;
        }
    }

    .boxWa {
        height: 70px;
        width: 310px;
        margin-top: 30px;
        float: right;
    }

    @media screen and (max-width: 768px) {
        .boxWa {
            width: 100%;
        }
    }

    .search {
        width: 80%;
        margin-top: 30px;
        margin-left: 10%;
    }

    * {
        margin: 0;
        padding: 0;
    }

    .rate {
        float: left;
        height: 46px;
        padding: 0 10px;
    }

    .rate:not(:checked)>input {
        position: absolute;
        top: -9999px;
    }

    .rate:not(:checked)>label {
        float: right;
        width: 1em;
        overflow: hidden;
        white-space: nowrap;
        cursor: pointer;
        font-size: 30px;
        color: #ccc;
    }

    .rate:not(:checked)>label:before {
        content: '★ ';
    }

    .rate>input:checked~label {
        color: #ffc700;
    }

    .rate:not(:checked)>label:hover,
    .rate:not(:checked)>label:hover~label {
        color: #deb217;
    }

    .rate>input:checked+label:hover,
    .rate>input:checked+label:hover~label,
    .rate>input:checked~label:hover,
    .rate>input:checked~label:hover~label,
    .rate>label:hover~input:checked~label {
        color: #c59b08;
    }

    .checked {
        color: orange;
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
<div id="contactUs">
    <div class="row" style="justify-content: center">
        <div class="card border-primary">
            <div class="card-body text-primary">
                <div class="row">
                    <img src="{{ $detail->gambar }}" alt="Gambar" class="responsive-image"
                        style="width: 96%; height:500px; margin-top: 40px !important; margin-left: 20px;">
                </div>
                <div class="row contactCard" style="justify-content: center;">
                    <div class="col-sm-12" style="margin-top: 40px">
                        <center>
                            <h4>{{ $detail->nama }}</h4>
                            <p class="text-dark">{{ $detail->deskripsi }}
                        </center>
                        </p>
                        <div class="row">
                            <div class="col-sm-4">
                                <p class="text-dark"><b>Alamat</b></p>
                            </div>
                            <div class="col-sm-8">
                                <p class="text-dark">: {{ $detail->alamat }}</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-4">
                                <p class="text-dark"><b>Link Map</b></p>
                            </div>
                            <div class="col-sm-8">
                                @if(isset($detail->link_map))
                                @php
                                if(isset($detail->link_map)){

                                $pattern = '/src="([^"]+)"/';
                                preg_match($pattern, $detail->link_map, $matches);
                                $src = isset($matches[1]) ? $matches[1] : null;

                                $array = explode('=', $src);

                                $data = array_filter(explode('!', $array[1]));

                                $location = $x = $y = '';
                                foreach ($data as $s) {
                                if (substr($s, 0, 2) == "2s" && strlen($s) > 5) {
                                $location = substr($s, 2);
                                } elseif (substr($s, 0, 2) == "3d" && strlen($s) > 5) {
                                $x = substr($s, 2);
                                } elseif (substr($s, 0, 2) == "2d" && strlen($s) > 5) {
                                $y = substr($s, 2);
                                }
                                }

                                if ($location != "" && $x != "" && $y != "") {
                                $result = 'https://www.google.com/maps/place/' . str_replace(' ', '',
                                urldecode($location)) . '/@' . $x . ','
                                . $y;
                                }
                                }
                                @endphp
                                : <a href="{{$result}}">{{$result}}</a>
                                @else
                                <p class="text-dark">: Belum ada link</a></p>
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-4">
                                <p class="text-dark"><b>Google Map</b></p>
                            </div>
                            <div class="col-sm-8">
                                @if(isset($detail->link_map))
                                {!! $detail->link_map !!}
                                @else
                                <p class="text-dark">: Belum ada link</a></p>
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-4">
                                <p class="text-dark"><b>Telepon</b></p>
                            </div>
                            <div class="col-sm-8">
                                <p class="text-dark">: {{ $detail->telpon }} or <a
                                        href="https://api.whatsapp.com/send?phone={{ $detail->telpon }}">Klik me</a></p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-4">
                                <p class="text-dark"><b>Fasilitas</b></p>
                            </div>
                            <div class="col-sm-8">
                                <p class="text-dark">: {{ $detail->fasilitas }}</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-4">
                                <p class="text-dark"><b>Jadwal</b></p>
                            </div>
                            <div class="col-sm-8">
                                <hr>
                                @foreach ($jadwal as $value)
                                <p class="text-dark">Hari : {{ $value->hari }}</p>
                                <p class="text-dark">Jam : {{ $value->jam }}</p>
                                <p class="text-dark">Tiket : Rp.{{ number_format($value->tiket, 0, ',', '.') }}</p>
                                <p class="text-dark">Opsional : {{ $value->opsional }}</p>
                                <hr>
                                @endforeach
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-4">
                                <p class="text-dark"><b>Umpan</b></p>
                            </div>
                            <div class="col-sm-8">
                                <p class="text-dark">: {{ $detail->umpan }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row" style="justify-content: center">
    <div class="card border-primary">
        <div class="card-body text-primary">
            <p>Ratings : </p>
            @foreach ($rating as $value)
            <div class="rate">
                @if ($value->rating == 5)
                <span class="fa fa-star checked"></span>
                <span class="fa fa-star checked"></span>
                <span class="fa fa-star checked"></span>
                <span class="fa fa-star checked"></span>
                <span class="fa fa-star checked"></span>
                @elseif ($value->rating == 4)
                <span class="fa fa-star checked"></span>
                <span class="fa fa-star checked"></span>
                <span class="fa fa-star checked"></span>
                <span class="fa fa-star checked"></span>
                <span class="fa fa-star"></span>
                @elseif ($value->rating == 3)
                <span class="fa fa-star checked"></span>
                <span class="fa fa-star checked"></span>
                <span class="fa fa-star checked"></span>
                <span class="fa fa-star"></span>
                <span class="fa fa-star"></span>
                @elseif ($value->rating == 2)
                <span class="fa fa-star checked"></span>
                <span class="fa fa-star checked"></span>
                <span class="fa fa-star"></span>
                <span class="fa fa-star"></span>
                <span class="fa fa-star"></span>
                @elseif ($value->rating == 1)
                <span class="fa fa-star checked"></span>
                <span class="fa fa-star"></span>
                <span class="fa fa-star"></span>
                <span class="fa fa-star"></span>
                <span class="fa fa-star"></span>
                @endif
            </div>
            <br>
            <br>
            <div class="komen">
                <label>Ulasan : {{ $value->komentar }}</label>
            </div>
            <hr>
            @endforeach
        </div>
    </div>
</div>
@if (empty($cekRating))
<div>
    <div class="row" style="justify-content: center">
        <div class="card border-primary">
            <div class="card-body text-primary">
                <form action="{{ route('pemancing.addRating') }}" method="POST">
                    @csrf
                    <div class="rate">
                        <input type="radio" id="star5" name="rate" value="5" required />
                        <label for="star5" title="text">5 stars</label>
                        <input type="radio" id="star4" name="rate" value="4" required />
                        <label for="star4" title="text">4 stars</label>
                        <input type="radio" id="star3" name="rate" value="3" required />
                        <label for="star3" title="text">3 stars</label>
                        <input type="radio" id="star2" name="rate" value="2" required />
                        <label for="star2" title="text">2 stars</label>
                        <input type="radio" id="star1" name="rate" value="1" required />
                        <label for="star1" title="text">1 star</label>
                    </div>
                    <br>
                    <input type="hidden" name="pemancingan_id" value="{{ $detail->id }}">
                    <br>
                    <div class="komen">
                        <label>Ulasan : </label>
                        <textarea name="komentar" id="komentar" cols="4" rows="2" class="form-control"
                            required></textarea>
                    </div>
                    <div class="col-sm-3 mt-4">
                        <button type="submit" class="btn btn-primary"><i class="fa fa-send"></i> Kirim</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@else
@endif
@endsection

@section('javascript')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
@endsection