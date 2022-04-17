<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=1080, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin - Login</title>
    <link href="{{ asset('img/ketaksaan-logo/ketaksaan-logo-white.png') }}" rel="icon">
    <link href="{{ asset('RA/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('RA/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('RA/css/ruang-admin.css') }}" rel="stylesheet">
    <link href="{{ asset('RA/css/custom.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('customlibrary/sweetalert/dist/sweetalert2.min.css') }}">
</head>

<body class="bg-gradient-login">
    <!-- Login Content -->
    <div class="container-login">
      <div class="row justify-content-center mt-lg-5">
        <div class="col-xl-4 col-lg-6 col-md-9">
          <div class="card shadow-sm my-5">
            <div class="card-body p-0">

              <div class="row">
                <div class="col-lg-12">
                  <div class="login-form">
                    <div class="text-center mb-4">
                        <h1 class="h4 text-gray-900">Login</h1>
                        <small>Masuk sebagai admin / resepsionis</small>
                    </div>
                    <form class="user" action="{{ route('auth.login') }}" method="post">
                      @csrf

                      <div class="form-group">
                        <input type="text" name="username" class="form-control" id="username" aria-describedby="usename"
                          placeholder="Enter Username" required>
                      </div>

                      <div class="form-group">
                        <div class="input-group mb-3">
                            <input type="password" name="password"
                                class="form-control @error('password') is-invalid @enderror" id="password"
                                placeholder="Masukan password" aria-describedby="basic-addon2" required>
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
                      </div>
                    </form>
                    <hr>
                    <div class="text-center">
                      <a class="font-weight-bold small" href="register.html">Lupa password ?</a>
                    </div>
                  </div>
                </div>
              </div>

            </div>
          </div>
        </div>
      </div>
    </div>

<script src="{{ asset('RA/vendor/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('RA/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('RA/vendor/jquery-easing/jquery.easing.min.js') }}"></script>
<script src="{{ asset('RA/js/ruang-admin.min.js') }}"></script>

{{-- library custom --}}
<script src="{{ asset('customlibrary/sweetalert/dist/sweetalert2.all.min.js') }}"></script>
<script src="{{ asset('customlibrary/fancybox/fancybox.umd.js') }}"></script>
<script>
    $(document).ready(function() {
        // show hide password
        $('.show-trigger').on('click', function() {
            var x = document.getElementById("password");
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

        // wrong message
        @if (session()->has('wrong'))
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
            icon: 'error',
            title: 'Ups! Username atau password salah'
            })
        @endif

        // wrong message
        @if (session()->has('access_denied'))
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
            icon: 'error',
            title: 'Maaf anda tidak memiliki hak akses'
            })
        @endif
    });
</script>

</html>
