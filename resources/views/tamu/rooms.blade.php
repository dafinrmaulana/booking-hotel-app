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
                <h5 class="card-title text-uppercase px-3 pt-3">Deluxe</h5>
                @if ($kamar->foto == null)
                <img style="cursor: pointer"
                data-fancybox data-src
                src="https://upload.wikimedia.org/wikipedia/commons/d/d1/Image_not_available.png"
                alt="foto kamar" class="img-fluid">
                @endif
                @if ($kamar->foto)
                    <img style="cursor: pointer"
                    data-fancybox data-src
                    src="{{ asset('img/kamar/' . $kamar->foto) }}"
                    alt="foto kamar" class="img-fluid">
                @endif
                <div class="card-body">
                    {{-- <span class="fa fa-star checked"></span>
                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star checked"></span>
                    <span class="fa fa-star"></span>
                    <span class="fa fa-star"></span> --}}

                    <p class="card-text">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Amet, corrupti.</p>

                    {{-- <div class="facilites-icon">
                        <i class="fas fa-wifi"></i><i class="fas fa-phone ml-2"></i><i class="fas fa-bed ml-2"></i>
                    </div> --}}
                    <br>

                    <strong class="price">Rp. 200.000,00 /Night</strong> <br>
                    <a href="#" class="btn btn-primary rounded-pill btn-pesan">Book Now</a>
                    <a href="#" class="btn btn-outline-success rounded-pill btn-pesan">Details</a>
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
