@extends('admin.master')
@section('title')
    RuangAdmin - Dashboard
@endsection
@section('main')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
        </ol>
    </div>

    <div class="row mb-3">
        <div class="row">
            <!-- Kamar tersedia Card -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-uppercase mb-1">Kamar tersedia</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $kamar }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-bed fa-2x text-primary"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- New User Card -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-uppercase mb-1">Tamu baru</div>
                                <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">{{ $tamu }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-users fa-2x text-info"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- New admin Card -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-uppercase mb-1">Admin</div>
                                <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">{{ $admin }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-user-shield fa-2x text-danger"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- New resepsionis Card -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-uppercase mb-1">Resepsionis</div>
                                <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">{{ $resepsionis }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-user-tie fa-2x text-success"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Pending Requests Card -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-uppercase mb-1">Pemesanan kamar</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $unpaid }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-comments fa-2x text-warning"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Checkin Card -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-uppercase mb-1">Check IN</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $checkin }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-check-circle fa-2x text-success"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Checkout Card -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-uppercase mb-1">Check OUT</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $checkout }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-sign-out-alt fa-2x text-danger"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- fasilitas Card -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-uppercase mb-1">Fasilitas kamar</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $fasilitasKamar }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-mug-hot fa-2x text-primary"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <div class="row">

        <!-- Area Chart -->
        <div class="col-xl-12 col-lg-12">
            <div class="card mb-4 pt-3">
                <div class="card-body">
                    <div class="chart-area">
                        <canvas id="myAreaChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

    </div>
 @endsection

 @push('vendor')
 <script src="{{ asset('RA/vendor/chart.js/Chart.min.js') }}"></script>
 @endpush
 @push('page-script')
 @include('admin.data_chart', ['data_chart'=>$data_chart])
 <script>
    // greeting message
    @if (session()->has('greeting'))
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
        title: "Sukses Login! Selamat datang {{ auth()->user()->nama }} "
        })
    @endif
 </script>
 @endpush

