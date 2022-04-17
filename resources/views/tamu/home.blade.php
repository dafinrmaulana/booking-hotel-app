@extends('tamu.master-tamu')
@section('title')
    Home
@endsection
@section('style')
    <link href="{{ asset('Guest/custom/guest.home.css') }}" rel="stylesheet" type="text/css">
@endsection

@section('header')
    {{-- jumbotron slider --}}
    <div class="jumbotron jumbotron-fluid">
        <div class="container text-center">
            <div id="carouselExampleSlidesOnly" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <h1 class="display-4 text-transform-capitalize">Home For your vacation</h1>
                        <p class="lead text-transform-capitalize">Make your vacation with our best services.</p>
                    </div>
                    <div class="carousel-item">
                        <h1 class="display-4 text-transform-capitalize">Relax Your Mind</h1>
                        <p class="lead text-transform-capitalize">We offer a beautiful view.</p>
                    </div>
                    <div class="carousel-item">
                        <h1 class="display-4 text-transform-capitalize">Place For A business trip</h1>
                        <p class="lead text-transform-capitalize">The right place for your business trip.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- end jumbotron slider --}}

    {{-- search room --}}
    <div class="container">
        <div class="row justify-content-center ">
            <div class="col-8 search-panel mb-3 shadow">
                <div class="row align-items-center">

                    <div class="col-lg-4">
                        <h3 class="display-6">Book <br /> Your Room now</h3>
                    </div>

                    <div class="col-12 col-lg-8">
                        <div class="row">
                            <div class="col-lg-5 p-2">
                                <div class="form-group">
                                    <input type="date" class="form-control" id="checkin" aria-describedby="checkin">
                                </div>
                            </div>

                            <div class="col-lg-5 p-2">
                                <div class="form-group">
                                    <input type="date" class="form-control" id="checkout" aria-describedby="checkout">
                                </div>
                            </div>

                            <div class="col-lg-5 p-2">
                                <div class="form-group">
                                    <input type="number" class="form-control" placeholder="Rooms Booked" id="jumlah"
                                        aria-describedby="jumlah">
                                </div>
                            </div>

                            <div class="col-lg-5 p-2 text-center">
                                <button class="btn btn-outline-primary tmbl-book">Book now</button>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    {{-- end search room --}}
@endsection

@section('main')
    {{-- About --}}
    <div class="container">
        <div class="row mb-4 mt-3">
            <div class="col-lg-6">
                @if (!empty($about->foto))
                    <img src="{{ asset('img/about/' . $about->foto) }}" alt="About foto" class="img-fluid rounded">
                @endif
            </div>
            @if (!empty($about->about))
                <div class="col-lg-6 about">
                    <h2 class="display-5">About Us</h2>
                    <br>
                    <p class="text-secondary"> {{ Str::limit($about->about, 250) }} </p>
                    <br>
                    <a href="" class="btn btn-warning rounded-0 text-light">Learn More</a>
                </div>
            @endif
        </div>
    </div>
    {{-- end about --}}
    

    {{-- Rooms --}}
    <div class="container">
        <div class="row justify-content-center mt-5 mb-3">
            <h3 class="display-5 text-uppercase">rooms</h3>
        </div>

        <div class="row">
            @foreach ($kamar as $kamar)
                <div class="col-lg-4 col-6 mb-4">
                    <div class="card shadow rounded-0">
                        <h6 class="card-title text-uppercase px-3 pt-3">{{ $kamar->nama_kamar }}</h6>
                        @if ($kamar->foto == null)
                            <img style="cursor: pointer" data-fancybox data-src
                                src="https://upload.wikimedia.org/wikipedia/commons/d/d1/Image_not_available.png"
                                alt="foto kamar" class="img-fluid">
                        @endif
                        @if ($kamar->foto)
                            <img style="cursor: pointer" data-fancybox data-src
                                src="{{ asset('img/kamar/' . $kamar->foto) }}" alt="foto kamar" class="img-fluid">
                        @endif
                        <div class="card-body">
                            {{-- <span class="fa fa-star checked"></span>
                        <span class="fa fa-star checked"></span>
                        <span class="fa fa-star checked"></span>
                        <span class="fa fa-star"></span>
                        <span class="fa fa-star"></span> --}}

                            <p class="card-text">{{ Str::limit($kamar->keterangan, 60) }}</p>

                            {{-- <div class="facilites-icon">
                            <i class="fas fa-wifi"></i><i class="fas fa-phone ml-2"></i><i class="fas fa-bed ml-2"></i>
                        </div> --}}
                            <br>

                            <strong class="price">Rp. {{ number_format($kamar->harga, 2, '.', '.') }}
                                /Night</strong> <br>
                            <a href="#" class="btn btn-primary rounded-pill btn-pesan mt-2">Book Now</a>
                            <a href="{{ route('detail-kamar.tamu', $kamar->id) }}"
                                class="btn btn-outline-success rounded-pill btn-pesan mt-2">Details</a>
                        </div>
                    </div>
                </div>
            @endforeach

        </div> {{-- End Row Rooms card --}}

        <div class="row justify-content-center mt-3">
            <a href="{{ route('guest.rooms') }}" class="btn btn-outline-primary rounded-0 btn-sm text-capitalize">find
                more</a>
        </div>
    </div>
    {{-- end rooms --}}

    {{-- hotel facilites --}}
    <div class="container">
        <div class="row justify-content-center mt-5 mb-3">
            <h3 class="display-5 text-uppercase">our facilities</h3>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row hotel-facilites-bg">
            @foreach ($fasilitas as $fasilitas)
                <div class="col-lg-3 col-md-3 col-6 mb-4 mt-5 text-center card-services">
                    <div class="card shadow position-relative card-serv border-0">
                        <div class="position-absolute p-1 px-2 rounded-bottom title-serv bg-warning font-weight-bold"
                            style="z-index: 2">
                            <p class="text-dark">{{ $fasilitas->nama_fasilitas_hotel }}</p>
                        </div>
                        <div class="card-body"
                            style="background-image: url({{ asset('img/fasilitasHotel/' . $fasilitas->foto) }}); background-size: cover; overflow: hidden">
                        </div>
                    </div>
                    <div class="parent-services-detail">
                        <a href="{{ route('detail-fasilitas-hotel.tamu', $fasilitas->id) }}"
                            class="btn btn-primary services-detail">Detail</a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    {{-- end hotel facilities --}}

    {{-- contact --}}
    <div class="container">
        <div class="row justify-content-center mt-5 mb-3">
            <h4 class="display-6 text-uppercase">contact us</h4>
        </div>
    </div>
    <div class="container">
        <div class="row mb-5 justify-content-center">
            <div class="col-lg-10">
                <div class="card border-0">
                    <div class="bg-primary text-light p-2 pl-4" style="font-size: 25px">
                        <i class="fas fa-envelope"></i> Drop Us A Message
                    </div>

                    <form action="{{ route('contact.kirim') }}">
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-6 mt-3">
                                    <div class="row">

                                        <div class="col-12">
                                            @error('name')
                                                <small class="form-text text-danger" id="name">{{ $message }}</small>
                                            @enderror
                                            <div class="input-group mb-3">

                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"
                                                    id="name">
                                                    <i class="fas fa-user-alt"></i></span>
                                                </div>

                                                <input
                                                type="text" value="{{ old('name') }}" class="form-control @error('name') is-invalid @enderror"
                                                name="name" placeholder="Your Full Name" aria-label="Your Full Name"
                                                aria-describedby="name">

                                            </div>
                                        </div>

                                        <div class="col-12">
                                            @error('email')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"
                                                    id="basic-addon1"><i
                                                    class="fas fa-envelope"></i></span>
                                                </div>
                                                <input type="email"
                                                value="{{ old('email') }}"
                                                class="form-control @error('email') is-invalid @enderror"
                                                name="email" placeholder="Your valid Email"
                                                aria-label="Your valid Email" aria-describedby="basic-addon1">
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            @error('subject')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text" id="basic-addon1"><i
                                                            class="fas fa-at"></i></span>
                                                </div>
                                                <input type="text"
                                                value="{{ old('subject') }}"
                                                class="form-control @error('subject') is-invalid @enderror"
                                                name="subject" placeholder="Subject" aria-label="Subject"
                                                aria-describedby="basic-addon1">
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            @error('phone')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"
                                                    id="basic-addon1"><i
                                                    class="fas fa-phone"></i></span>
                                                </div>
                                                <input type="phone"
                                                value="{{ old('phone') }}"
                                                class="form-control  @error('phone') is-invalid @enderror" name="phone"
                                                placeholder="Your Phone Number" aria-label="Your Phone Number"
                                                aria-describedby="basic-addon1">
                                            </div>
                                        </div>

                                    </div>
                                </div>

                                <div class="col-lg-6 mt-3">
                                    @error('message')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                    <textarea name="message"
                                    value="{{ old('message') }}"
                                    class="form-control  @error('message') is-invalid @enderror"
                                    cols="55" rows="8"
                                    placeholder=" Your Message"></textarea>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg">
                                    <button type="submit" class="btn btn-primary">Send Message</button>
                                </div>
                            </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
    </div>
    {{-- end contact --}}
@endsection
