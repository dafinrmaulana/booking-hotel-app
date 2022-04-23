@extends('admin.master')
@section('title')
    RuangAdmin - Cetak Inovice
@endsection
@section('main')
    <x-breadcrumb title="Cetak invoice">
        <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('manage-pemesanan.index') }}">Manage Pemesanan</a></li>
        <li class="breadcrumb-item active" aria-current="page">Cetak Pemesanan</li>
    </x-breadcrumb>

    <div class="row">
        <div class="col-lg-10">
            <div class="row">
                <div class="col-12 mx-auto d-flex justify-content-end">
                    <div class="btn-group mb-1 mt-2">
                        <button type="button" style="box-shadow: none !important; margin-right: -2px" class="btn btn-danger dropdown-toggle dropdown-toggle-split"
                          data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          <span class="sr-only"></span>
                        </button>
                        <div class="dropdown-menu">
                          <a class="dropdown-item" onclick="printPDF()" href="#">Cetak PDF</a>
                        </div>
                        <a href="{{ route('email.kirim', $data->id) }}" class="btn btn-danger" style="box-shadow: none !important"> <i class="fas fa-envelope-open-text"></i> Kirim email</a>
                      </div>
                </div>
            </div>
            <div class="card mb-5" id="printContent" style="box-shadow: none !important">
                <div class="row">
                    <div class="col-lg-7">
                        <img src="{{ asset('img/ketaksaan-logo/Ketaksaan_hotel-logos_transparent.png') }}" alt="ketaksaan hotel logo" width="210" class="mt-4 mx-3">
                        <p class="mx-3 my-3" style="font-family: 'Source Sans Pro', sans-serif;">Tol Gate Fukushima, Ruko Kaguya C 88-99 Grand, Hatake, Kec. Konoha, Kab. Isekai, Jawa Script 46300</p>
                    </div>
                    <div class="col-lg-5 text-right">
                        <p class="text-uppercase font-weight-bold mx-3 mt-4" style="opacity: .5; font-family: 'Source Sans Pro', sans-serif;">
                            #IKH-{{ $data->id }} invoice
                        </p>
                        <table class="float-right mx-3 mb-2">
                            <tr>
                                <td>Ph +10 9889 8765</td>
                            </tr>
                            <tr>
                                <td class="text-info" >ketaksaan@hotel.com</td>
                            </tr>
                            <tr>
                                <td>{{ date('l d M Y', strtotime($data->tanggal_dipesan)) }}</td>
                            </tr>
                            <tr>
                                <td>{{ $data->nama_pemesan }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div class="row">
                    <div class="col-11 border-top border-info mx-auto">
                        <div class="row">
                            <div class="col-6">
                                <div class="card border my-3" style="box-shadow: none !important">

                                    <div class="card-body">
                                        <h5 class="card-title text-capitalize" style="color: black; font-family: 'Source Sans Pro', sans-serif;">Booking Details</h5>
                                        <div class="row border-bottom py-2">
                                            <div class="col-6" style="font-family: 'Source Sans Pro', sans-serif;">Nama kamar</div>
                                            <div class="col-6">{{ $data->kamar->nama_kamar }}</div>
                                        </div>
                                        <div class="row border-bottom py-2">
                                            <div class="col-6" style="font-family: 'Source Sans Pro', sans-serif;">Check In</div>
                                            <div class="col-6">{{ date('l d M Y', strtotime($data->tanggal_checkin)) }}</div>
                                        </div>
                                        <div class="row py-2">
                                            <div class="col-6" style="font-family: 'Source Sans Pro', sans-serif;">Check Out</div>
                                            <div class="col-6">{{ date('l d M Y', strtotime($data->tanggal_checkout)) }}</div>
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
                                        <div class="row mt-2 foot-booking">
                                            <div class="col-5">
                                                {{ $data->nama_tamu }}
                                            </div>
                                            <div class="col-7">
                                                {{ $data->email }} <br> {{ $data->no_hp }}
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
                                            <div class="col-6" style="font-family: 'Source Sans Pro', sans-serif;">{{ $data->kamar->nama_kamar }}</div>
                                            <div class="col-6">Rp. {{ number_format($data->kamar->harga, 2, ',', '.') }}</div>
                                        </div>
                                        <div class="row border-bottom py-2">
                                            <div class="col-6" style="font-family: 'Source Sans Pro', sans-serif;">Jumlah Kamar Dipesan</div>
                                            <div class="col-6">{{ $data->jumlah_kamar_dipesan }} kamar</div>
                                        </div>
                                        <div class="row py-2 foot-booking">
                                            <div class="col-6" style="font-family: 'Source Sans Pro', sans-serif;">Durasi Inap</div>
                                            <div class="col-6">
                                                <?php
                                                $date1=date_create($data->tanggal_checkin);
                                                $date2=date_create($data->tanggal_checkout);
                                                $diff=date_diff($date1,$date2);
                                                echo $diff->format("%a Malam");
                                                ?>
                                            </div>
                                        </div>
                                        <div class="row mt-2">
                                            <div class="col-5">
                                                Total
                                            </div>
                                            <div class="col-7 border-top d-flex justify-content-between">
                                                <p>Rp. {{  number_format($data->kamar->harga*$data->jumlah_kamar_dipesan*$diff->format("%a"), 2, ',', '.') }} </p><p>(x)</p>
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
@push('page-script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.5.3/jspdf.debug.js" integrity="sha512-cLuyDTDg9CSseBSFWNd4wkEaZ0TBEpclX0zD3D6HjI19pO39M58AgJ1SjHp6c7ZOp0/OCRcC2BCvvySU9KJaGw==" crossorigin="anonymous"></script>
<script src="http://html2canvas.hertzen.com/dist/html2canvas.js"></script>
<script src="{{ asset('customlibrary/printElement.min.js') }}"></script>
<script>
    function printPDF() {
            html2canvas(document.getElementById('printContent'))
            .then((canvas) => {
                const imgData = canvas.toDataURL('image/png');
                const pdf = new jsPDF({
                orientation: 'landscape',
                });
                const imgProps= pdf.getImageProperties(imgData);
                const pdfWidth = pdf.internal.pageSize.getWidth();
                const pdfHeight = (imgProps.height * pdfWidth) / imgProps.width;
                pdf.addImage(imgData, 'PNG', 0, 0, pdfWidth, pdfHeight);
                pdf.save('invoice-pemesanan.pdf');
            });
        }
</script>
@endpush
