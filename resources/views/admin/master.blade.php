<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=1080, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>@yield('title')</title>
    <link href="{{ asset('img/ketaksaan-logo/ketaksaan-logo-white.png') }}" rel="icon">
    <link href="{{ asset('RA/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('RA/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('RA/css/ruang-admin.css') }}" rel="stylesheet">
    <link href="{{ asset('RA/css/custom.css') }}" rel="stylesheet">
    <link href="{{ asset('RA/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('customlibrary/sweetalert/dist/sweetalert2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('customlibrary/fancybox/fancybox.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro:wght@600&display=swap" rel="stylesheet">
</head>

<body id="page-top">
    <div id="wrapper">
        <!-- Sidebar -->
        <ul class="navbar-nav sidebar sidebar-light accordion" id="accordionSidebar">
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
                <div class="sidebar-brand-icon">
                    <img src="{{ asset('img/ketaksaan-logo/ketaksaan-logo-white.png') }}">
                </div>
                <div class="sidebar-brand-text mx-3">Ketaksaan Admin</div>
            </a>
            <hr class="sidebar-divider my-0">

            <li class="nav-item {{ 'admin/dashboard' == request()->path() ? 'active' : '' }}">
                <a class="nav-link"
                href="{{ route('dashboard.index') }}">
                    <i class="fas fa-chart-line"></i>
                    <span>Dashboard</span>
                </a>
            </li>

            <hr class="sidebar-divider">
            <div class="sidebar-heading">
                Features
            </div>
            <li class="nav-item {{ 'admin/manage-pemesanan' == request()->path() ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('manage-pemesanan.index') }}">
                    <i class="fas fa-fw fa-book"></i>
                    <span>Pemesanan</span>
                </a>
            </li>


            @if (Auth::guard('admin')->user()->role == 'admin')
            <li class="nav-item {{ 'admin/manage-fasilitas-hotel' == request()->path() ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('manage-fasilitas-hotel.index') }}">
                    <i class="fab fa-accusoft"></i>
                    <span>Fasilitas Hotel</span>
                </a>
            </li>
            @endif

            @if (Auth::guard('admin')->user()->role == 'admin')
            <li class="nav-item {{ 'admin/manage-about' == request()->path() ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('manage-about.index') }}">
                    <i class="fas fa-hotel"></i>
                    <span>About</span>
                </a>
            </li>
            @endif

            @if (Auth::guard('admin')->user()->role == 'admin')
            <li class="nav-item">
                <a class="nav-link
                @if ( 'admin/manage-admin' == request()->path() )
                    collapsed
                @elseif ( 'admin/manage-tamu' == request()->path() )
                    collapsed
                @elseif ( 'admin/manage-pemesanan' == request()->path() )
                    collapsed
                @endif"
                href="#" data-toggle="collapse" data-target="#collapseTable" aria-expanded="true"
                aria-controls="collapseTable">
                <i class="fas fa-bed"></i>
                <span>Kamar</span>
                </a>
                <div id="collapseTable" class="collapse
                @if ('admin/manage-kamar' == request()->path())
                    show
                @elseif ('admin/manage-fasilitas-kamar' == request()->path())
                    show
                @endif"
                aria-labelledby="headingTable"
                data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Kamar</h6>
                        <a class="collapse-item {{ 'admin/manage-kamar' == request()->path() ? 'active' : '' }}"
                            href="{{ route('manage-kamar.index') }}">Manage kamar</a>
                        <a class="collapse-item {{ 'admin/manage-fasilitas-kamar' == request()->path() ? 'active' : '' }}"
                            href="{{ route('manage-fasilitas-kamar.index') }}">Manage fasilitas</a>
                    </div>
                </div>
            </li>
            @endif

            @if (Auth::guard('admin')->user()->role == 'admin')
            <li class="nav-item">
                <a class="nav-link
                @if ( 'admin/manage-kamar' == request()->path() )
                    collapsed
                @elseif ( 'admin/manage-fasilitas-kamar' == request()->path() )
                    collapsed
                @elseif ( 'admin/manage-pemesanan' == request()->path() )
                    collapsed
                @endif"
                    href="#" data-toggle="collapse" data-target="#collapseForm" aria-expanded="true"
                    aria-controls="collapseForm">
                    <i class="fab fa-fw fa-wpforms"></i>
                    <span>Akun</span>
                </a>
                <div id="collapseForm"
                    class="collapse {{ 'admin/manage-tamu' == request()->path() ? 'show' : '' }} {{ 'admin/manage-admin' == request()->path() ? 'show' : '' }}"
                    aria-labelledby="headingForm" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Akun</h6>
                        <a class="collapse-item {{ 'admin/manage-admin' == request()->path() ? 'active' : '' }}"
                            href="{{ route('manage-admin.index') }}">Admin</a>
                        <a class="collapse-item {{ 'admin/manage-tamu' == request()->path() ? 'active' : '' }}"
                            href="{{ route('manage-tamu.index') }}">Tamu</a>
                    </div>
                </div>
            </li>
            @endif

            <hr class="sidebar-divider mt-auto">
            <div class="version" id="version-ruangadmin"></div>
        </ul>
        <!-- Sidebar end -->

        <div id="content-wrapper" class="d-flex flex-column">

            <div id="content">
                <!-- TopBar -->
                <nav class="navbar navbar-expand navbar-light bg-navbar topbar mb-4 static-top">
                    <button id="sidebarToggleTop" class="btn btn-link rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                                aria-labelledby="searchDropdown">
                                <form class="navbar-search">
                                    <div class="input-group">
                                        <input type="text" class="form-control bg-light border-1 small"
                                            placeholder="What do you want to look for?" aria-label="Search"
                                            aria-describedby="basic-addon2" style="border-color: #3f51b5;">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button">
                                                <i class="fas fa-search fa-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </li>
                        <div class="topbar-divider d-none d-sm-block"></div>
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <img class="img-profile rounded-circle" src="{{ asset('RA/img/boy.png') }}"
                                    style="max-width: 60px">
                                <span class="ml-2 d-none d-lg-inline text-white small">{{ Auth::guard('admin')->user()->nama }}</span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="javascript:void(0);" data-toggle="modal"
                                    data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>
                    </ul>
                </nav>
                <!-- Topbar -->

                <!-- Container Fluid-->
                <div class="container-fluid" id="container-wrapper">
                    @yield('main')
                    <!--Row-->

                    <!-- Modal Logout -->
                    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog"
                        aria-labelledby="exampleModalLabelLogout" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabelLogout">Ohh No!</h5>
                                    <button type="button" class="close" data-dismiss="modal"
                                        aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <p>Yakin mau logout?</p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-outline-primary"
                                        data-dismiss="modal">Cancel</button>
                                    <a href="{{ route('auth.logout') }}" class="btn btn-danger">Logout</a>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <!---Container Fluid-->
            </div>

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>copyright &copy;
                            <script>
                                document.write(new Date().getFullYear());
                            </script> - developed by
                            <b><a href="https://indrijunanda.gitlab.io/" target="_blank">indrijunanda</a></b>
                        </span>
                    </div>
                </div>
            </footer>
            <!-- Footer -->
        </div>
    </div>

    <!-- Scroll to top -->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <script src="{{ asset('RA/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('RA/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('RA/vendor/jquery-easing/jquery.easing.min.js') }}"></script>
    <script src="{{ asset('RA/js/ruang-admin.min.js') }}"></script>

    {{-- fasilitas --}}
    {{-- <script src="https://cdn.jsdelivr.net/npm/semantic-ui@2.2.13/dist/semantic.min.js"></script> --}}

    {{-- touchspin --}}
    <script src="{{ asset('RA/vendor/bootstrap-touchspin/js/jquery.bootstrap-touchspin.js') }}"></script>

    {{-- chart --}}
    @stack('vendor')

    {{-- table pemesanan --}}
    <script src="{{ asset('RA/vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('RA/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

    {{-- library custom --}}
    <script src="{{ asset('customlibrary/sweetalert/dist/sweetalert2.all.min.js') }}"></script>
    <script src="{{ asset('customlibrary/fancybox/fancybox.umd.js') }}"></script>
    <script>
        $(document).ready(function() {
            // create modal error
            @if ($errors->any())
                $('#createModal').modal('show');
            @endif

            // store message
            @if (session()->has('store'))
                const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3600,
                timerProgressBar: true,
                didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
                })

                Toast.fire({
                icon: 'success',
                title: 'Sukses! Data berhasil ditambahkan'
                })
            @endif
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
                title: 'Sukses! email berhasil dikirim'
                })
            @endif

            // delete message
            @if (session()->has('delete'))
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
                title: 'Oke data berhasil di hapus'
                })
            @endif

            // update message
            @if (session()->has('update'))
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
                title: 'Sip data berhasil di ubah'
                })
            @endif
        });
    </script>
    @stack('page-script')

</body>

</html>
