<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=1080, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Ketaksaan Hotel | @yield('title')</title>
    @yield('style')
    <link href="{{ asset('img/ketaksaan-logo/ketaksaan-logo-white.png') }}" rel="icon">
    <link href="{{ asset('Guest/bootstrap-4/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('RA/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="{{ asset('customlibrary/fancybox/fancybox.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
</head>

<body id="page-top">

    {{-- top bar --}}
    <div class="container">
        <nav class="navbar navbar-light navbar-expand-lg">
            <a class="navbar-brand" href="#">
                <img src="{{ asset('img/ketaksaan-logo/Ketaksaan_hotel-logos_transparent.svg') }}"
                    style="filter: invert(40%) sepia(95%) saturate(1120%) hue-rotate(162deg) brightness(80%) contrast(101%);"
                    width="150" alt="ketaksaan logo">
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup"
                aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav">
                    <a class="nav-link {{ '/' == request()->path() ? 'active' : '' }}" href="{{ route('guest.home') }}">Home</a>
                    <a class="nav-link {{ 'rooms' == request()->path() ? 'active' : '' }}" href="{{ route('guest.rooms') }}">Rooms</a>
                    <a class="nav-link" href="#">Facilites</a>
                    <a class="nav-link" href="#">About</a>
                    @if (Auth::user())
                    <a class="nav-link" href="#">{{ Auth::user()->nama_tamu }}</a>
                    @else
                    <button type="button" class="btn btn-primary tmbl rounded-pill" data-toggle="modal" data-target="#loginModal">Login</button>
                    @endif
                </div>
            </div>
        </nav>
    </div>
    {{-- end top bar --}}

    <!-- Modal -->
    <div class="modal fade" id="loginModal" tabindex="-1"  aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header border-bottom-0">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="row justify-content-center pb-3">
                <div class="col-lg-10">
                    <div class="login-form">
                    <div class="text-center mb-4">
                        <h1 class="h4 text-gray-900">Login</h1>
                        <small>Welcome Back !</small>
                    </div>
                    <form class="user" action="{{ route('auth.login') }}" method="post">
                        @csrf

                        <div class="form-group">
                        <input type="text" name="username" class="form-control" id="username_login" aria-describedby="usename"
                            placeholder="Enter Username">
                        </div>

                        <div class="form-group">
                        <div class="input-group mb-3">
                            <input type="password" name="password"
                                class="form-control @error('password') is-invalid @enderror" id="password_login"
                                placeholder="Enter password" aria-describedby="basic-addon2">
                            <div class="input-group-append show-trigger">
                                <span class="input-group-text" id="basic-addon2">
                                    <i class="fas fa-eye d-none" id="hide_eye"></i>
                                    <i class="fas fa-eye-slash" id="show_eye"></i>
                                </span>
                            </div>
                        </div>
                        </div>

                        <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-block">Login</button>
                        <button type="button" class="btn btn-secondary btn-block" data-dismiss="modal" aria-label="Close" data-toggle="modal" data-target="#signinModal">Sign Up For Free</button>
                        </div>
                    </form>
                    <hr>
                    <div class="text-center">
                        <a class="font-weight-bold small" href="register.html">Forgot password ?</a>
                    </div>
                    </div>
                </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="signinModal" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header border-bottom-0">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>

            <div class="row justify-content-center pb-3">
              <div class="col-lg-10">
                <div class="login-form">

                  <div class="text-center mb-4">
                      <h1 class="h4 text-gray-900">Register Your Account</h1>
                      <small>Welcome To Ketaksaan Hotel</small>
                  </div>
                  <form class="user" action="{{ route('register.guest') }}" method="post">
                    @csrf

                    <div class="form-group">
                      <input type="email" name="email_regist" value="{{ old('email_regist') }}" class="form-control @error('email_regist') is-invalid @enderror" id="email" aria-describedby="usename"
                        placeholder="Enter email">
                        @error('email_regist')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group">
                      <input type="text" name="no_hp_regist" value="{{ old('no_hp_regist') }}" class="form-control @error('no_hp_regist') is-invalid @enderror" id="username" aria-describedby="usename"
                        placeholder="Enter Phone Number">
                        @error('no_hp_regist')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group">
                      <input type="text" name="nama_regist" value="{{ old('nama_regist') }}" class="form-control @error('nama_regist') is-invalid @enderror" id="username" aria-describedby="usename"
                        placeholder="Enter your Full name">
                        @error('nama_regist')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group">
                      <div class="input-group mb-3">
                          <input type="password" name="password_regist"
                              class="form-control @error('password_regist') is-invalid @enderror" id="password_regist"
                              placeholder="Enter password" aria-describedby="basic-addon2">
                          <div class="input-group-append show-trigger-2">
                              <span class="input-group-text" id="basic-addon2">
                                  <i class="fas fa-eye d-none" id="hide_eye_regist"></i>
                                  <i class="fas fa-eye-slash" id="show_eye_regist"></i>
                              </span>
                          </div>
                      </div>
                      @error('password_regist')
                      <small class="text-danger message-pass-regis">{{ $message }}</small>
                      @enderror
                    </div>

                    <div class="form-group">
                      <div class="input-group mb-3">
                          <input type="password" name="password_confirmation_regist"
                              class="form-control @error('password') is-invalid @enderror" id="password"
                              placeholder="Confirm the password" aria-describedby="basic-addon2">
                      </div>
                    </div>

                    <div class="form-group">
                      <button type="submit" class="btn btn-primary btn-block">Sign Up</button>
                    </div>
                  </form>
                  <hr>
                  <div class="text-center">
                    <a class="font-weight-bold small" href="register.html">Forgot password ?</a>
                  </div>
                </div>
              </div>
            </div>

        </div>
        </div>
    </div>

    {{-- header --}}
    @yield('header')
    {{-- end header --}}

    {{-- main --}}
    @yield('main')
    {{-- end main --}}

    {{-- footer --}}
    {{-- <div class="container-fluid">
        <div class="row footer-parent">

            <div class="container">
                <div class="row mt-3">
                    <div class="col-lg-4">
                        <p class="text-uppercase text-light title-footer">about agency</p>
                        <p class="main-footer">Lorem ipsum dolor sit amet consectetur adipisicing elit. Minima, iusto. Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptates, harum.</p>
                    </div>
                    <div class="col-lg-2">
                        <p class="text-uppercase text-light title-footer">Navigation Bar</p>
                        <table>
                            <tr>
                                <td class="pr-3 main-footer"><a href="{{ route('guest.home') }}">Home</a></td>
                                <td class="main-footer"><a href="">About</a></td>
                            </tr>
                            <tr>
                                <td class="pr-3 main-footer"><a href="{{ route('guest.rooms') }}">Rooms</a></td>
                                <td class="main-footer"><a href="">Facilites</a></td>
                            </tr>
                            <tr>
                                <td class="pr-3 main-footer"><a href="">Contact</a></td>
                                <td class="main-footer"><a href="">Log In</a></td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-lg-3">
                        <p class="text-uppercase text-light title-footer">Rooms</p>
                        <table>
                            <tr>
                                <td class="pr-3 main-footer">Deluxe Standart</td>
                                <td class="main-footer">Deluxe premium</td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-lg-3">
                        <p class="text-uppercase text-light title-footer">Facilites</p>
                        <table>
                            <tr>
                                <td class="pr-2 main-footer">Swimming Pool</td>
                                <td class="main-footer">Business room</td>
                            </tr>
                            <tr>
                                <td class="pr-2 main-footer">Restaurant</td>
                                <td class="main-footer">Bar</td>
                            </tr>
                            <tr>
                                <td class="pr-2 main-footer">Free Smoking room</td>
                                <td class="main-footer">Best Services</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>

            <div class="container">
                <div class="row justify-content-center mt-2">
                    <div class="col-lg-11 text-center pt-2 pb-2 copyright main-footer">
                        <span>copyright &copy;
                            <script>
                                document.write(new Date().getFullYear());
                            </script> - developed by
                            <b><a href="https://github.com/DafiNMaulana/" target="_blank">Dafi Nurrohman Maulana</a></b>
                        </span>
                    </div>
                </div>
            </div>

        </div>
    </div> --}}
    <footer class="sticky-footer footer-parent py-3">
        <div class="container my-auto">
            <div class="copyright text-center my-auto copyright main-footer">
                <span>copyright &copy;
                    <script>
                        document.write(new Date().getFullYear());
                    </script> - developed by
                    <b><a href="https://github.com/DafiNMaulana/" target="_blank">Dafi Nurrohman Maulana</a></b>
                </span>
            </div>
        </div>
    </footer>
    {{-- end footer --}}

    <script src="{{ asset('RA/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('RA/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('customlibrary/fancybox/fancybox.umd.js') }}"></script>
    <script>
        // sign up error
        @if ($errors->has('username_regist'))
            $('#signinModal').modal('show');
        @endif
        @if ($errors->has('email_regist'))
            $('#signinModal').modal('show');
        @endif
        @if ($errors->has('password_regist'))
            $('#signinModal').modal('show');
        @endif
        @if ($errors->has('password_confirmation_regist'))
            $('#signinModal').modal('show');
        @endif

        // show hide password
        $('.show-trigger').on('click', function() {
            var x = document.getElementById("password_login");
            var show_eye = document.getElementById("show_eye");
            var hide_eye = document.getElementById("hide_eye");
            $('#hide_eye').removeClass("d-none");
            if (x.type === "password") {
                x.type = "text";
                show_eye.style.display = "none";
                hide_eye.style.display = "block";
            } else {
                x.type = "password";
                show_eye.style.display = "block";
                hide_eye.style.display = "none";
            }
        });

        $('.show-trigger-2').on('click', function() {
            var x = document.getElementById("password_regist");
            var show_eye = document.getElementById("show_eye_regist");
            var hide_eye = document.getElementById("hide_eye_regist");
            $('#hide_eye_regist').removeClass("d-none");
            if (x.type === "password") {
                x.type = "text";
                show_eye.style.display = "none";
                hide_eye.style.display = "block";
            } else {
                x.type = "password";
                show_eye.style.display = "block";
                hide_eye.style.display = "none";
            }
        });

        // register message
        @if (session()->has('regist'))
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
            title: 'Selamat! Akun berhasil di daftarkan'
            })
        @endif
    </script>
</body>
