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

<div class="container">
    <div class="row justify-content-center mt-4">
        <div class="col-lg-12 col-12">
            <div class="card shadow">
                <div class="container">
                    <form action="{{ route('guest.roomOrder', $kamar->id) }}" method="post">
                        @csrf
                    <div class="row">
                        <div class="col-lg-6 p-2">
                            <div class="form-group">
                                <label for="checkin">Check IN</label>
                                <input type="date"
                                class="form-control"
                                placeholder="Check IN"
                                name="checkin"
                                id="checkin"
                                value="{{ \Carbon\Carbon::now()->format('Y-m-d')}}"
                                aria-describedby="checkin">
                            </div>
                        </div>

                        <div class="col-lg-6 p-2">
                            <div class="form-group">
                                <label for="checkin">Check OUT</label>
                                <input type="date"
                                name="checkout"
                                class="form-control"
                                placeholder="Check OUT"
                                value="{{ \Carbon\Carbon::tomorrow()->format('Y-m-d')}}"
                                id="checkout" aria-describedby="checkout">
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('main')
    <div class="container">
        <div class="row mb-3 mt-5">
            <div class="col-lg-8">
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

            <div class="col-lg-4 booked-room">
                <div class="card">
                    <div class="card-header">
                        <h5>Booking Your Rooms Now</h5>
                    </div>
                    <div class="card-body">
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group mb-3">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1"><i class="fas fa-user-alt"></i></span>
                                            </div>

                                            <input type="text"
                                            class="form-control @error('nama_tamu') is-invalid @enderror"
                                            placeholder="Guest Name"
                                            name="nama_tamu"
                                            aria-label="Guest Name"
                                            aria-describedby="basic-addon1">
                                        </div>
                                        @error('nama_tamu')
                                        <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="form-group mb-3">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1"><i class="fas fa-book"></i></span>
                                            </div>

                                            <input type="number"
                                            class="form-control @error('jumlah_kamar_dipesan') is-invalid @enderror"
                                            placeholder="Total Room Order"
                                            name="jumlah_kamar_dipesan"
                                            aria-label="Guest Name"
                                            aria-describedby="basic-addon1">
                                        </div>
                                        @error('jumlah_kamar_dipesan')
                                        <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="form-group mb-3">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1"><i class="fas fa-phone"></i></span>
                                            </div>

                                            <input type="text"
                                            class="form-control @error('no_hp') is-invalid @enderror"
                                            placeholder="Phone Number ( optional )"
                                            name="no_hp"
                                            id="no_hp"
                                            aria-label="Guest Name"
                                            aria-describedby="basic-addon1">
                                        </div>
                                        @error('no_hp')
                                        <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>

                                @if (Auth::user()->email_verified_at != null)
                                <div class="col-12">
                                <button type="submit" class="btn btn-primary">Book Now</button>
                                </div>
                                @else
                                <div class="col-12">
                                <button type="button" class="btn btn-dark tmbl" data-toggle="modal" data-target="#loginModal">Login / Verified First</button>
                                </div>
                                @endif
                            </div>
                        </form>

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
                                <div class="col-lg-3">Rooms Available</div>
                                <div class="col-lg-1">:</div>
                                <div class="col-lg-8"><strong>{{ $kamar->jumlah }} Are available</strong></div>
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

@push('guest-page-script')
<script>
    // ----------------------------------Guest Page----------------------------------
    function setInputFilter(textbox, inputFilter) {
        ["input", "keydown", "keyup", "mousedown", "mouseup", "select", "contextmenu", "drop"].forEach(
            function(event) {
                textbox.addEventListener(event, function() {
                    if (inputFilter(this.value)) {
                        this.oldValue = this.value;
                        this.oldSelectionStart = this.selectionStart;
                        this.oldSelectionEnd = this.selectionEnd;
                    } else if (this.hasOwnProperty("oldValue")) {
                        this.value = this.oldValue;
                        this.setSelectionRange(this.oldSelectionStart, this.oldSelectionEnd);
                    } else {
                        this.value = "";
                    }
                });
            });
    }
    setInputFilter(document.getElementById("no_hp"), function(value) {
        return /^\d*\.?\d*$/.test(value); // Allow digits and '.' only, using a RegExp
    });
</script>
@endpush
