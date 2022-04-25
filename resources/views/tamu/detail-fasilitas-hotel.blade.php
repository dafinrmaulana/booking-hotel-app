@extends('tamu.master-tamu')
@section('title')
    Hotel Facilities
@endsection
@section('style')
<link href="{{ asset('Guest/custom/guest.rooms.css') }}" rel="stylesheet" type="text/css">
@endsection
@section('header')
<div class="container">
    <div class="row">
        <div class="col-lg-12 text-center">
            <div class="breadcrumb-text">
                <h2>Detail {{ $fasilitas->nama_fasilitas_hotel }}</h2>
                <div class="bt-option">
                    <a href="{{ route('guest.home') }}">Home</a>
                    <i class="fas fa-angle-right"></i>
                    <span>Detail Hotel Facilities</span>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('main')
    <div class="container">
        <div class="row mt-4 mb-4">
            <div class="col-lg-6">
                @if ($fasilitas->foto == null)
                <img style="cursor: pointer"
                data-fancybox data-src
                src="https://upload.wikimedia.org/wikipedia/commons/d/d1/Image_not_available.png"
                alt="foto fasilitas" class="img-fluid  shadow">
                @endif
                @if ($fasilitas->foto)
                    <img style="cursor: pointer"
                    data-fancybox data-src
                    src="{{ asset('img/fasilitasHotel/' . $fasilitas->foto) }}"
                    alt="foto fasilitas" class="img-fluid  shadow">
                @endif
            </div>
            <div class="col-lg-6">
                <h5 class=" text-about">About This Facilities</h5>
                <br>
                <p>{{ $fasilitas->keterangan }}</p>
            </div>
        </div>
    </div>
@endsection
