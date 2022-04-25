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
                <h2>Our Facilities</h2>
                <div class="bt-option">
                    <a href="./home.html">Home</a>
                    <i class="fas fa-angle-right"></i>
                    <span>Facilities</span>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('main')
<div class="container-fluid">
    <div class="row hotel-facilites-bg mb-5 pb-5">
        @foreelse ($fasilitas as $fasilis)
            <div class="col-lg-3 col-md-3 col-6 mb-4 mt-5 text-center card-services">
                <div class="card shadow position-relative card-serv border-0">
                    <div class="position-absolute p-1 px-2 rounded-bottom title-serv bg-warning font-weight-bold"
                        style="z-index: 2">
                        <p class="text-dark">{{ $fasilis->nama_fasilitas_hotel }}</p>
                    </div>
                    <div class="card-body"
                        style="background-image: url({{ asset('img/fasilitasHotel/' . $fasilis->foto) }}); background-size: cover; overflow: hidden">
                    </div>
                </div>
                <div class="parent-services-detail">
                    <a href="{{ route('detail-fasilitas-hotel.tamu', $fasilis->id) }}"
                        class="btn btn-primary services-detail">Detail</a>
                </div>
            </div>
        @empty 

        @endforeelse
    </div>
    <div class="row justify-content-center">
        {{ $fasilitas->links() }}
    </div>

</div>
@endsection
