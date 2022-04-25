@extends('tamu.master-tamu')
@section('title')
Rooms Result
@endsection
@section('style')
<link href="{{ asset('Guest/custom/guest.rooms.css') }}" rel="stylesheet" type="text/css">
@endsection
@section('header')
<div class="container">
    <div class="row">
        <div class="col-lg-12 text-center">
            <div class="breadcrumb-text">
                <h2>Our Available Room</h2>
                <div class="bt-option">
                    <a href="./home.html">Home</a>
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
    <div class="row mt-4">
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
                        <a href="{{ route('detail-kamar.tamu-search', $kamar->id) }}"
                        class="btn btn-primary btn-pesan mt-2">Book Now</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div> {{-- End Row Rooms card --}}

    <div class="row justify-content-center mb-5">
        <nav aria-label="Page navigation example">
            <ul class="pagination">
              <li class="page-item">
                <a class="page-link" href="#" aria-label="Previous">
                  <span aria-hidden="true">&laquo;</span>
                  <span class="sr-only">Previous</span>
                </a>
              </li>
              <li class="page-item"><a class="page-link" href="#">1</a></li>
              <li class="page-item"><a class="page-link" href="#">2</a></li>
              <li class="page-item"><a class="page-link" href="#">3</a></li>
              <li class="page-item">
                <a class="page-link" href="#" aria-label="Next">
                  <span aria-hidden="true">&raquo;</span>
                  <span class="sr-only">Next</span>
                </a>
              </li>
            </ul>
          </nav>
    </div>
</div>
@endsection
