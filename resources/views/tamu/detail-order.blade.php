@extends('tamu.master-tamu')
@section('title')
Order Detail
@endsection
@section('style')
<link rel="stylesheet" href="{{ asset('Guest/custom/guest.rooms.css') }}">
@endsection

@section('header')
<div class="container-fluid pt-2 container-detail-order">
    <div class="row">
        <div class="col-lg-12 text-center">
            <div class="breadcrumb-text">
                <h2>Order Detail</h2>
                <div class="bt-option">
                    <a href="{{ route('guest.home') }}">Home</a>
                    <i class="fas fa-angle-right"></i>
                    <a href="{{ route('detail-kamar.tamu', $kamar->id) }}">Detail Rooms</a>
                    <i class="fas fa-angle-right"></i>
                    <span>Order Detail</span>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('main')
<div class="container-fluid p-5 container-detail-order">
    <div class="row mb-4 mt-4">
        <div class="col-lg-7">
            <div class="card border-0 shadow-sm">

                <!-- card detail guest  -->
                <div class="container">
                    <div class="row p-3">
                        <div class="col-lg-5">
                            @if ($pemesanan->kamar->foto)
                            <img src="{{ asset('img/kamar/'. $pemesanan->kamar->foto) }}" alt="" class="img-fluid border rounded">
                            @endif
                            @if ($pemesanan->kamar->foto === null)
                            <img style="cursor: pointer" data-fancybox data-src
                            class="border rounded"
                            src="https://upload.wikimedia.org/wikipedia/commons/d/d1/Image_not_available.png" alt="foto kamar"
                            width="100%">
                            @endif
                        </div>

                        <div class="col-lg-7">
                            <h5 class="border-bottom p-3"> <i class="fas fa-hotel"></i> {{ $pemesanan->kamar->nama_kamar }}</h5>
                            <div class="row">
                                <div class="col">
                                    <h6 class="text-secondary">Check-in</h6>
                                    <h6 class="display-6">{{ date('d M Y', strtotime($pemesanan->tanggal_checkin)) }}</h6>
                                </div>
                                <div class="col">
                                    <h6 class="text-secondary">Check-out</h6>
                                    <h6 class="display-6">{{ date('d M Y', strtotime($pemesanan->tanggal_checkout)) }}</h6>
                                </div>
                                <div class="col">
                                    <h6 class="text-secondary">Duration</h6>
                                    <h6 class="display-6">
                                        <?php
                                        $date1=date_create($pemesanan->tanggal_checkin);
                                        $date2=date_create($pemesanan->tanggal_checkout);
                                        $diff=date_diff($date1,$date2);
                                        echo $diff->format("%a Night");
                                        ?>
                                    </h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- booking details -->
                <div class="container">
                    <div class="row p-3">
                        <div class="col-lg-8 border-top pt-3">
                            <h5>
                            <strong>Booking Detail</strong>
                            </h5>

                            <div class="row">
                                <div class="col-lg-5 col-6">
                                <p class="text-secondary">Guest Name</p>
                                </div>
                                <div class="col-lg-6 col-6">
                                <strong>{{ $pemesanan->nama_tamu }}</strong>
                                </div>
                            </div>

                            <div class="row mt-n3">
                                <div class="col-lg-5 col-6">
                                <p class="text-secondary">Total Ordered Rooms</p>
                                </div>
                                <div class="col-lg-6 col-6">
                                <strong>{{ $pemesanan->jumlah_kamar_dipesan }}</strong>
                                </div>
                            </div>

                            <div class="row mt-n3">
                                <div class="col-lg-5 col-6">
                                <p class="text-secondary">Room Price</p>
                                </div>
                                <div class="col-lg-6 col-6">
                                <strong>Rp. {{ number_format($pemesanan->kamar->harga, 2, ',', '.') }}</strong>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4 mt-lg-0 pt-3 border-top">
                            <h5 class="mb-4">
                            <strong>Room Facilities</strong>
                            </h5>
                            @forelse ($kamar->fasilitas as $fasi)
                            @php
                            $fasil = $faska->where('id', $fasi->id)->first();
                            @endphp
                            <p class="mt-n3"> <i class="fas fa-check text-success "></i> {{ $fasil->nama_fasilitas}}</p>
                            @empty
                            <p class="mt-n3" style="font-size: 14px"><i class="fas fa-times-circle text-danger "></i> This room has no facilities</p>
                            @endforelse
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <!-- payments detail -->
        <div class="col-lg-5 mt-lg-0 mt-3">
            <div class="container">
            <div class="row">
                <div class="col-lg-12 mb-3">
                    <div class="card rounded border-0 shadow-sm">
                        <div class="card-header bg-transparent">
                        <h5>Payments Detail</h5>
                        </div>
                        <div class="card-body">
                        <div class="container">
                            <div class="row">
                                <div class="col-4">
                                Order By
                                </div>
                                <div class="col-8 text-right">
                                <strong class="text-capitalize" style="font-size: 15px">{{ $pemesanan->nama_pemesan }}</strong>
                                </div>
                            </div>

                            <div class="row pt-1">
                                <div class="col-4">
                                    Duration
                                </div>
                                <div class="col-8 text-right">
                                    <strong>
                                        <?php
                                        $date1=date_create($pemesanan->tanggal_checkin);
                                        $date2=date_create($pemesanan->tanggal_checkout);
                                        $diff=date_diff($date1,$date2);
                                        echo $diff->format("%a Night");
                                        ?>
                                    </strong>
                                </div>
                            </div>

                            <div class="row pt-1">
                                <div class="col-6">
                                    Total Price
                                    <p style="font-size: 13px">( {{ $pemesanan->jumlah_kamar_dipesan }} Room x {{ $diff->format("%a Night") }} )</p>
                                </div>
                                <div class="col-6 text-right">
                                    <strong class="text-capitalize" style="font-size: 15px">
                                    Rp. {{ number_format($pemesanan->kamar->harga*$pemesanan->jumlah_kamar_dipesan*$diff->format("%a"), 2, ',', '.') }}
                                    </strong>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <select class="custom-select" id="method-select" aria-label="Example select with button addon">
                                    <option value="0" selected>Payment Method...</option>
                                    <option value="1">Online Payment Method (Available soon) </option>
                                    <option value="2">Pay On Receptionist</option>
                                </select>
                            </div>

                            <div class="row pt-1 border-top justify-content-center text-center">
                            <button class="btn btn-dark rounded-0 mt-1" id="pay-now" disabled>
                                <i class="fas fa-credit-card"></i>
                                Pay Now
                            </button>
                            <button class="btn btn-dark rounded-0 mt-1" id="pay-later">
                                <i class="fas fa-hand-holding-usd"></i>
                                Pay on receptionist
                            </button>
                            </div>
                        </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-12">
                    <div class="card rounded border-0 shadow-sm">
                        <div class="card-header bg-transparent">
                        <h5>Contacts Detail</h5>
                        </div>
                        <div class="card-body mb-n4 mt-2">
                            <div class="container">
                                <div class="row mt-n2">
                                    <div class="col-4">
                                    <p>Full Name</p>
                                    </div>
                                    <div class="col-8 text-right">
                                    <p class="text-capitalize font-weight-bold">{{ $pemesanan->nama_pemesan }}</p>
                                    </div>
                                </div>
                            </div>

                            <div class="container">
                                <div class="row mt-n2">
                                    <div class="col-4">
                                    <p>Email</p>
                                    </div>
                                    <div class="col-8 text-right">
                                    <p class="font-weight-bold">{{ $pemesanan->email }}</p>
                                    </div>
                                </div>
                            </div>

                            <div class="container">
                                <div class="row mt-n2">
                                    <div class="col-4">
                                    <p>Phone</p>
                                    </div>
                                    <div class="col-8 text-right">
                                        @if ($pemesanan->phone)
                                        <p class="text-capitalize font-weight-bold">{{ $pemesanan->no_hp }}</p>
                                        @else
                                        <p class="text-capitalize font-weight-bold"> - </p>
                                        @endif
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>
            </div>
            </div>
        </div>
    </div>

    <!-- privacy policies -->
    <div class="row mb-4 card-privacy-policies">
        <div class="col-lg-7">
            <div class="card shadow-sm">
                <div class="card-header bg-dark rounded-0">
                    <h5 class="font-weight text-light rounded-0 border-0">
                        Privacy Policies
                    </h5>
                </div>
                <div class="card-body">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-4 border-right">
                                <h5>Check-in Instruction
                                <br>
                                ( Online Payment Method ) </h5>
                            </div>
                            <div class="col-lg-8">
                                <p>
                                    After the Customer successfully makes a payment, the Guest will be
                                    issued an <strong class="text-capitalize" style="text-decoration: underline">E-booking id card</strong> as proof of payment. so that when the Guest
                                    checks in, the Guest only has to submit their personal data to the
                                    receptionist in the form of an ID card/steering license, for example
                                </p>
                            </div>
                        </div>

                        <div class="row pt-4">
                            <div class="col-lg-4 border-right">
                                <h5>Check-in Instruction
                                <br>
                                ( Pay on receptionist method ) </h5>
                            </div>
                            <div class="col-lg-8">
                                <p>
                                    after the room reservation is successfully made, the user will be
                                    given a <strong class="text-capitalize" style="text-decoration: underline">E-booking id card</strong> which serves as proof of the reservation, so
                                    the user only needs to show it to the receptionist and then pay the bill.
                                    <strong>the <strong class="text-capitalize" style="text-decoration: underline">E-booking id card</strong> is only valid for 7 days after ordering</strong>, after that day the
                                    booking is considered <strong class="text-danger">cancelled</strong>.
                                </p>
                            </div>
                        </div>

                        <div class="row pt-4">
                            <div class="col-lg-4 border-right">
                                <h5>Cancelation Policy</h5>
                            </div>
                            <div class="col-lg-8">
                                <p>
                                    This booking is non-refundable. The time displayed is according
                                    to the accommodation local time, the date of stay and the room
                                    type cannot be changed
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('guest-page-script')
<script>
$(document).ready(function() {

    // ---------------------------- payment method on change ------------------------------
    $('#pay-now').show();
    $('#pay-later').hide();
    $('#method-select').on('change', function() {
        $value = this.value;
        if ($value == '0' || $value == '1') {
            $('#pay-now').show();
            $('#pay-later').hide();
        } else {
            $('#pay-later').show();
        $('#pay-now').hide();
        }
    });
    // ---------------------------- payment method on change end ------------------------------

    // ---------------------------- payment method popup confirm ------------------------------
    $('#pay-later').click(function(e) {
        e.preventDefault();
        var id = $(this).data('id');
        Swal.fire({
            title: 'Are You Sure?',
            text: "Are you sure want to book this room? *",
            icon: 'info',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sure'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location = "{{ route('makeEbooking', $pemesanan->id) }}"
            }
        })
    });
    // ---------------------------- payment method popup confirm end ------------------------------

});
</script>
@endpush
