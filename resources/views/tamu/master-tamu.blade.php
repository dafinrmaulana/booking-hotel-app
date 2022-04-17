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
                    <button type="button" class="btn btn-primary tmbl rounded-pill" href="#">Login</button>
                </div>
            </div>
        </nav>
    </div>
    {{-- end top bar --}}

    {{-- header --}}
    @yield('header')
    {{-- end header --}}

    {{-- main --}}
    @yield('main')
    {{-- end main --}}

    {{-- footer --}}
    <div class="container-fluid">
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
                                <td class="pr-3 main-footer">Home</td>
                                <td class="main-footer">About</td>
                            </tr>
                            <tr>
                                <td class="pr-3 main-footer">Rooms</td>
                                <td class="main-footer">Facilites</td>
                            </tr>
                            <tr>
                                <td class="pr-3 main-footer">Contact</td>
                                <td class="main-footer">Log In</td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-lg-3">
                        <p class="text-uppercase text-light title-footer">Rooms</p>
                        <table>
                            <tr>
                                <td class="pr-3 main-footer">Deluxe Standar</td>
                                <td class="main-footer">Deluxe premium</td>
                            </tr>
                            <tr>
                                <td class="pr-3 main-footer">Traveler room</td>
                                <td class="main-footer">King Room</td>
                            </tr>
                            <tr>
                                <td class="pr-3 main-footer">3 Star room</td>
                                <td class="main-footer">Double Bed</td>
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
                        Copyright 2022 Build By Dafi Nurrohman Maulana
                    </div>
                </div>
            </div>

        </div>
    </div>
    {{-- end footer --}}

    <script src="{{ asset('RA/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('RA/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('customlibrary/fancybox/fancybox.umd.js') }}"></script>
</body>
