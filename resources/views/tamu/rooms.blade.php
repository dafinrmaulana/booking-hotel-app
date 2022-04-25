@extends('tamu.master-tamu')
@section('title')
    Rooms
@endsection
@section('style')
<link href="{{ asset('Guest/custom/guest.rooms.css') }}" rel="stylesheet" type="text/css">
@endsection
@section('header')
<div class="container">
    <div class="row">
        <div class="col-lg-12 text-center">
            <div class="breadcrumb-text">
                <h2>Our Rooms</h2>
                <div class="bt-option">
                    <a href="/home">Home</a>
                    <i class="fas fa-angle-right"></i>
                    <span>Rooms</span>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('main')
<div class="container">
    <div class="row mt-4 mb-4">
        @foreach ($kamar as $kamars)
            <div class="col-lg-4 col-6 mb-4">
                <div class="card shadow rounded-0">
                    <h6 class="card-title text-uppercase px-3 pt-3">{{ $kamars->nama_kamar }}</h6>
                    @if ($kamars->foto == null)
                        <img style="cursor: pointer" data-fancybox data-src
                            src="https://upload.wikimedia.org/wikipedia/commons/d/d1/Image_not_available.png"
                            alt="foto kamar" class="img-fluid">
                    @endif
                    @if ($kamars->foto)
                        <img style="cursor: pointer" data-fancybox data-src
                            src="{{ asset('img/kamar/' . $kamars->foto) }}" alt="foto kamar" class="img-fluid">
                    @endif
                    <div class="card-body">
                        {{-- <span class="fa fa-star checked"></span>
                        <span class="fa fa-star checked"></span>
                        <span class="fa fa-star checked"></span>
                        <span class="fa fa-star"></span>
                        <span class="fa fa-star"></span> --}}

                        <p class="card-text">{{ Str::limit($kamars->keterangan, 60) }}</p>

                        {{-- <div class="facilites-icon">
                        <i class="fas fa-wifi"></i><i class="fas fa-phone ml-2"></i><i class="fas fa-bed ml-2"></i>
                        </div> --}}
                        <br>

                        <strong class="price">Rp. {{ number_format($kamars->harga, 2, '.', '.') }}
                            /Night</strong> <br>
                        <a href="{{ route('detail-kamar.tamu', $kamars->id) }}"
                        class="btn btn-primary btn-pesan mt-2">Details</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div> {{-- End Row Rooms card --}}

    <div class="row justify-content-center mb-5">
        {{ $kamar->links() }}
    </div>
</div>
@endsection
