@extends('tamu.master-tamu')
@section('title')
Detail Rooms
@endsection
@section('style')
<link href="{{ asset('Guest/custom/guest.rooms.css') }}" rel="stylesheet" type="text/css">
@endsection
@section('header')
<div class="container">
    <div class="row">
        <div class="col-lg-12 text-center">
            <div class="breadcrumb-text">
                <h2>Detail {{ $kamar->nama_kamar }}</h2>
                <div class="bt-option">
                    <a href="{{ route('guest.home') }}">Home</a>
                    <i class="fas fa-angle-right"></i>
                    <span>Detail Rooms</span>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('main')
    <div class="container">
        <div class="row mb-3 mt-5">
            <div class="col-lg-6">
                @if ($kamar->foto == null)
                <img style="cursor: pointer"
                data-fancybox data-src
                src="https://upload.wikimedia.org/wikipedia/commons/d/d1/Image_not_available.png"
                alt="foto kamar" class="img-fluid shadow">
                @endif
                @if ($kamar->foto)
                    <img style="cursor: pointer"
                    data-fancybox data-src
                    src="{{ asset('img/kamar/' . $kamar->foto) }}"
                    alt="foto kamar" class="img-fluid shadow">
                @endif
            </div>

            <div class="col-lg-6 booked-room">
                <div class="card">
                    <div class="card-header">
                        <h5>Booking Your Rooms Now</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-6">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1"><i class="fas fa-user-alt"></i></span>
                                    </div>

                                    <input type="text" class="form-control" placeholder="Guest Name" aria-label="Guest Name" aria-describedby="basic-addon1">
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1"><i class="fas fa-book"></i></span>
                                    </div>

                                    <input type="number" class="form-control" placeholder="Total" aria-label="Total" aria-describedby="basic-addon1">
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1"><i class="fas fa-calendar-check"></i></span>
                                    </div>
                                    <input type="text" class="form-control" onfocus="(this.type='date')" onblur="(this.type='text')" placeholder="Check IN" aria-label="Check IN" aria-describedby="basic-addon1">
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1"><i class="fas fa-calendar-day"></i></span>
                                    </div>
                                    <input type="text" class="form-control" onfocus="(this.type='date')" onblur="(this.type='text')" placeholder="Check OUT" aria-label="Check IN" aria-describedby="basic-addon1">
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1"><i class="fas fa-phone"></i></span>
                                    </div>
                                    <input type="text" class="form-control" placeholder="Check OUT" aria-label="Check IN" aria-describedby="basic-addon1">
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1"><i class="fas fa-user-tie"></i></span>
                                    </div>
                                    <input type="text" class="form-control" placeholder="Check OUT" aria-label="Check IN" aria-describedby="basic-addon1">
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1"><i class="fas fa-envelope"></i></span>
                                    </div>
                                    <input type="email" class="form-control" placeholder="Email" aria-label="Check IN" aria-describedby="basic-addon1">
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1"><i class="fas fa-envelope"></i></span>
                                    </div>
                                    <input type="email" class="form-control" placeholder="Confirm Email" aria-label="Check IN" aria-describedby="basic-addon1">
                                </div>
                            </div>
                            <div class="col-12">
                                <button class="btn btn-primary">Book Now</button>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-lg-8 mb-3">
                <div class="card">
                    <div class="card-header">Room Information</div>
                    <div class="card-body">
                        <div class="container">
                            <div class="row pt-2">
                                <div class="col-lg-3">Room Name</div>
                                <div class="col-lg-1">:</div>
                                <div class="col-lg-8"><strong>{{ $kamar->nama_kamar }}</strong></div>
                            </div>
                            <div class="row pt-2">
                                <div class="col-lg-3">Price</div>
                                <div class="col-lg-1">:</div>
                                <div class="col-lg-8"><strong>Rp. {{ number_format($kamar->harga, 2, ',', '.') }}</strong></div>
                            </div>
                            <div class="row pt-2">
                                <div class="col-lg-3">About this room</div>
                                <div class="col-lg-1">:</div>
                                <div class="col-lg-8"><strong>{{ $kamar->keterangan }}</strong></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 card-fasilitas">
                <div class="card">
                    <div class="card-header">
                        <h5>Facilities</h5>
                    </div>
                    <div class="card-body">
                        @forelse ($kamar->fasilitas as $fasi)
                        @php
                            $fasil = $faska->where('id', $fasi->id)->first();
                        @endphp
                        <p class="text-success"> <i class="fas fa-check"></i> {{ $fasil->nama_fasilitas}}</p>
                        @empty
                        <p class="text-danger"><i class="fas fa-times-circle"></i> This room has no facilities</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
