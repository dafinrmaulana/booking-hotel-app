@extends('tamu.master-tamu')
@section('title')
Make E-Card
@endsection
@section('style')
<link rel="stylesheet" href="{{ asset('Guest/custom/guest.rooms.css') }}">
<link href="{{ asset('RA/css/custom.css') }}" rel="stylesheet">
@endsection
@section('header')
<div class="container-fluid pt-2">
    <div class="row">
        <div class="col-lg-12 text-center">
            <div class="breadcrumb-text">
                <h2>Make E-Booking Card</h2>
                <div class="bt-option">
                    <a href="{{ route('guest.home') }}">Home</a>
                    <i class="fas fa-angle-right"></i>
                    <a href="{{ route('detail-kamar.tamu', $kamar->id) }}">Detail Room</a>
                    <i class="fas fa-angle-right"></i>
                    <a href="{{ route('guest.paymentDetail', $pemesanan->id) }}">Payment</a>
                    <i class="fas fa-angle-right"></i>
                    <span>Order Detail</span>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('main')
<div class="container-fluid container-detail-order pb-5">

    <div class="row justify-content-center">
        <div class="col-lg-9" style="overflow: scroll">
            <div style="width: 60rem">
                <div class="row">
                    <div class="col-12 mx-auto d-flex justify-content-end">
                        <div class="btn-group mb-1 mt-2">
                            <button type="button" style="box-shadow: none !important; margin-right: -2px" class="btn btn-danger dropdown-toggle dropdown-toggle-split"
                              data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              <span class="sr-only"></span>
                            </button>
                            <div class="dropdown-menu">
                              <a class="dropdown-item" onclick="printPDF()" href="#">Print PDF</a>
                            </div>
                            <a href="{{ route('email.kirim.guest', $pemesanan->id) }}" class="btn btn-danger" style="box-shadow: none !important">
                                <i class="fas fa-envelope-open-text"></i> Send email</a>
                          </div>
                    </div>
                </div>
                <div class="card mb-5 border-0" id="printContent">
                    {{-- ------------------header---------------- --}}
                    <div class="row">
                        <div class="col-lg-7">
                            <img src="{{ asset('img/ketaksaan-logo/Ketaksaan_hotel-logos_transparent.png') }}" alt="ketaksaan hotel logo" width="210" class="mt-4 mx-3">
                            <p class="mx-3 my-3" style="font-family: 'Source Sans Pro', sans-serif;">Tol Gate Fukushima, Ruko Kaguya C 88-99 Grand, Hatake, Kec. Konoha, Kab. Isekai, Jawa Script 46300</p>
                        </div>
                        <div class="col-lg-5 text-right">
                            <p class="text-uppercase font-weight-bold mx-3 mt-4" style="opacity: .5; font-family: 'Source Sans Pro', sans-serif;">
                                #IKH-{{ $pemesanan->id }} invoice
                            </p>
                            <table class="float-right mx-3 mb-2">
                                <tr>
                                    <td>Ph +10 9889 8765</td>
                                </tr>
                                <tr>
                                    <td class="text-info" >ketaksaan@hotel.com</td>
                                </tr>
                                <tr>
                                    <td>{{ date('l d M Y', strtotime($pemesanan->tanggal_dipesan)) }}</td>
                                </tr>
                                <tr>
                                    <td>{{ $pemesanan->nama_pemesan }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    {{-- ------------------header end---------------- --}}

                    <div class="row">
                        <div class="col-11 border-top border-info mx-auto">
                            <div class="row">
                                <div class="col-6">
                                    <div class="card border my-3" style="box-shadow: none !important">

                                        <div class="card-body">
                                            <h5 class="card-title text-capitalize" style="color: black; font-family: 'Source Sans Pro', sans-serif;">Booking Details</h5>
                                            <div class="row border-bottom py-2">
                                                <div class="col-6" style="font-family: 'Source Sans Pro', sans-serif;">Room Name</div>
                                                <div class="col-6">{{ $pemesanan->kamar->nama_kamar }}</div>
                                            </div>
                                            <div class="row border-bottom py-2">
                                                <div class="col-6" style="font-family: 'Source Sans Pro', sans-serif;">Check In</div>
                                                <div class="col-6">{{ date('l d M Y', strtotime($pemesanan->tanggal_checkin)) }}</div>
                                            </div>
                                            <div class="row py-2">
                                                <div class="col-6" style="font-family: 'Source Sans Pro', sans-serif;">Check Out</div>
                                                <div class="col-6">{{ date('l d M Y', strtotime($pemesanan->tanggal_checkout)) }}</div>
                                            </div>
                                            <div class="row">
                                                <span class="line">
                                                    <h2 class="border-bottom">
                                                        <span style="font-family: 'Source Sans Pro', sans-serif;" class="text-uppercase">
                                                            guests
                                                        </span>
                                                    </h2>
                                                </span>
                                            </div>
                                            <div class="row mt-2">
                                                <div class="col-5">
                                                    Order By
                                                </div>
                                                <div class="col-7 text-right">
                                                    <strong class="text-capitalize">{{ $pemesanan->nama_pemesan }}</strong>
                                                </div>
                                            </div>
                                            <div class="row mt-2 foot-booking">
                                                <div class="col-5">
                                                    Email
                                                </div>
                                                <div class="col-7 text-right">
                                                    <strong>{{ $pemesanan->email }}</strong>
                                                </div>
                                            </div>
                                            <div class="row mt-2">
                                                <div class="col-5">
                                                    Guest
                                                </div>
                                                <div class="col-7 text-right">
                                                    <strong class="text-capitalize">{{ $pemesanan->nama_tamu }}</strong>
                                                </div>
                                            </div>
                                            <div class="row mt-2 foot-booking">
                                                <div class="col-5">
                                                    ID Booking
                                                </div>
                                                <div class="col-7 text-right">
                                                    <strong class="text-capitalize">{{ 'ID#RKH-'.$pemesanan->id.$pemesanan->kamar->id. date('m', strtotime($pemesanan->tanggal_checkin)) }}</strong>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="card border my-3" style="box-shadow: none !important">

                                        <div class="card-body">
                                            <h5 class="card-title text-capitalize" style="color: black; font-family: 'Source Sans Pro', sans-serif;">Invoice</h5>
                                            <div class="row bord5r-bottom py-2 foot-booking">
                                                <div class="col-6" style="font-family: 'Source Sans Pro', sans-serif;">{{ $pemesanan->kamar->nama_kamar }}</div>
                                                <div class="col-6">Rp. {{ number_format($pemesanan->kamar->harga, 2, ',', '.') }}</div>
                                            </div>

                                            <div class="row border-bottom py-2">
                                                <div class="col-6" style="font-family: 'Source Sans Pro', sans-serif;">Total ordered rooms</div>
                                                <div class="col-6">{{ $pemesanan->jumlah_kamar_dipesan }} room</div>
                                            </div>

                                            <div class="row py-2 foot-booking">
                                                <div class="col-6" style="font-family: 'Source Sans Pro', sans-serif;">Duration</div>
                                                <div class="col-6">
                                                    {{ $lamanya.' Night' }}
                                                </div>
                                            </div>

                                            <div class="row mt-2">
                                                <div class="col-5">
                                                    Total
                                                </div>
                                                <div class="col-7 border-top d-flex justify-content-between">
                                                    <p>Rp. {{  number_format($pemesanan->kamar->harga*$pemesanan->jumlah_kamar_dipesan*$lamanya, 2, ',', '.') }} </p><p>(x)</p>
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
        </div>
    </div>
</div>
@endsection

@push('guest-page-script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.5.3/jspdf.debug.js" integrity="sha512-cLuyDTDg9CSseBSFWNd4wkEaZ0TBEpclX0zD3D6HjI19pO39M58AgJ1SjHp6c7ZOp0/OCRcC2BCvvySU9KJaGw==" crossorigin="anonymous"></script>
<script src="http://html2canvas.hertzen.com/dist/html2canvas.js"></script>
<script src="{{ asset('customlibrary/printElement.min.js') }}"></script>
<script>
    function printPDF() {
        html2canvas(document.getElementById('printContent'))
        .then((canvas) => {
            const imgData = canvas.toDataURL('image/png');
            const pdf = new jsPDF({
            orientation: 'portrait',
            });
            const imgProps= pdf.getImageProperties(imgData);
            const pdfWidth = pdf.internal.pageSize.getWidth();
            const pdfHeight = (imgProps.height * pdfWidth) / imgProps.width;
            pdf.addImage(imgData, 'PNG', 0, 0, pdfWidth, pdfHeight);
            pdf.save('invoice.pdf');
        });
    }

    // store message
    @if (session()->has('email'))
        const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3500,
        timerProgressBar: true,
        didOpen: (toast) => {
        toast.addEventListener('mouseenter', Swal.stopTimer)
        toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
        })

        Toast.fire({
        icon: 'success',
        title: 'Success! email has been sent'
        })
    @endif
</script>
@endpush
