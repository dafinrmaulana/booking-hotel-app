@extends('tamu.master-tamu')
@section('title')
Order Detail
@endsection
@section('style')
<link rel="stylesheet" href="{{ asset('Guest/custom/guest.rooms.css') }}">
@endsection

@section('header')
<div class="container">
    <div class="row">
        <div class="col-lg-12 text-center">
            <div class="breadcrumb-text">
                <h2>Order Detail</h2>
                <div class="bt-option">
                    <a href="{{ route('guest.home') }}">Home</a>
                    <i class="fas fa-angle-right"></i>
                    <a href="{{ route('guest.home') }}">Detail Rooms</a>
                    <i class="fas fa-angle-right"></i>
                    <span>Order Detail</span>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('main')
<div class="container">
    <div class="row mb-4 mt-4">
        <div class="col-lg-8">

            <div class="card rounded-0">

                <div class="card-header bg-dark rounded-0">
                    <h5 class="text-light">Booking Details</h5>
                </div>

                <div class="card-body">
                    <div class="row border-bottom">
                        <div class="col-lg-5 col-5">
                        <p>Guest Name</p>
                        </div>
                        <div class="col-lg-1 col-1">:</div>
                        <div class="col-lg-6 col-6">
                        <p class="text-capitalize">{{ $pemesanan->nama_tamu }}</p>
                        </div>
                    </div>
                    <div class="row border-bottom pt-3">
                        <div class="col-lg-5 col-5">
                        <p>Room Name</p>
                        </div>
                        <div class="col-lg-1 col-1">:</div>
                        <div class="col-lg-6 col-6">
                        <p class="text-capitalize">{{ $pemesanan->kamar->nama_kamar }}</p>
                        </div>
                    </div>
                    <div class="row border-bottom pt-3">
                        <div class="col-lg-5 col-5">
                        <p>Room Price</p>
                        </div>
                        <div class="col-lg-1 col-1">:</div>
                        <div class="col-lg-6 col-6">
                            <p>Rp. {{ number_format($pemesanan->kamar->harga, 2, ',', '.') }}</p>
                        </div>
                    </div>
                    <div class="row border-bottom pt-3">
                        <div class="col-lg-5 col-5">
                        <p>Total Room</p>
                        </div>
                        <div class="col-lg-1 col-1">:</div>
                        <div class="col-lg-6 col-6">
                            <p>{{ $pemesanan->jumlah_kamar_dipesan }}</p>
                        </div>
                    </div>
                    <div class="row border-bottom pt-3">
                        <div class="col-lg-5 col-5">
                        <p>Check IN</p>
                        </div>
                        <div class="col-lg-1 col-1">:</div>
                        <div class="col-lg-6 col-6">
                            <p>{{ date('l, d-M-Y', strtotime($pemesanan->tanggal_checkin)) }}</p>
                        </div>
                    </div>
                    <div class="row pt-3">
                        <div class="col-lg-5 col-5">
                        <p>Check OUT</p>
                        </div>
                        <div class="col-lg-1 col-1">:</div>
                        <div class="col-lg-6 col-6">
                            <p>{{ date('l, d-M-Y', strtotime($pemesanan->tanggal_checkout)) }}</p>
                        </div>
                    </div>
                </div>

            </div>

        </div>
        <div class="col-lg-4 mt-lg-0 mt-3">
            <div class="card rounded-0">
                <div class="card-header bg-dark rounded-0">
                    <h5 class="text-light">Payment Detail</h5>
                </div>
                <div class="card-body">
                    <div class="container">

                        {{-- order by --}}
                        <div class="row">
                            <div class="col-lg-6 col-6">
                            <strong>Order By</strong>
                            </div>
                            <div class="col-lg-6 col-6 text-right text-capitalize">
                            {{ $pemesanan->nama_pemesan }}
                            </div>
                        </div>
                        {{-- Total Room --}}
                        <div class="row">
                            <div class="col-lg-6 col-6">
                            <strong>Total Room</strong>
                            </div>
                            <div class="col-lg-6 col-6 text-right">
                            {{ $pemesanan->jumlah_kamar_dipesan }} Room
                            </div>
                        </div>

                        {{-- Duration --}}
                        <div class="row">
                            <div class="col-lg-6 col-6">
                                <strong>Duration</strong>
                            </div>
                            <div class="col-lg-6 col-6 text-right">
                                <?php
                                $date1=date_create($pemesanan->tanggal_checkin);
                                $date2=date_create($pemesanan->tanggal_checkout);
                                $diff=date_diff($date1,$date2);
                                echo $diff->format("%a Night");
                                ?>
                            </div>
                        </div>

                        {{-- Total price --}}
                        <div class="row">
                            <div class="col-lg-6 col-6">
                            <strong>Total Price</strong>
                            <div class="total-price">( {{ $pemesanan->jumlah_kamar_dipesan }} Room x {{ $diff->format("%a") }} Night )</div>
                            </div>
                            <div class="col-lg-6 col-6 text-right">
                            <strong>Rp. {{  number_format($pemesanan->kamar->harga*$pemesanan->jumlah_kamar_dipesan*$diff->format("%a"), 2, ',', '.') }}</strong>
                            </div>
                        </div>

                        {{-- payment Button --}}
                        <div class="row border-top mt-3 justify-content-center">
                            <div class="col-12 text-center mt-2">
                                <a href="" class="btn btn-dark rounded-0"> <i class="fas fa-dollar-sign text-light"></i> Pay Now</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mb-4">
        <div class="col-lg-8">
            <div class="card rounded-0">
                <div class="card-header bg-dark rounded-0">
                    <h5 class="text-light">Privacy Policies</h5>
                </div>
                <div class="card-body mt-lg-n3">
                    <div class="row">
                        <div class="col-lg-3 col-3">
                        <p>Check IN Instruction</p>
                        </div>
                        <div class="col-lg-9 col-9 border-left">
                        <p>
                        When the customer has successfully made an order,
                        we will make an e-ticket so that when the guest checks
                        in, the guest only needs to show their personal data in
                        the form of an ID card / driving license to the receptionist
                        and enjoy the accommodation </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
