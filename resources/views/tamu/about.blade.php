@extends('tamu.master-tamu')
@section('title')
    about
@endsection
@section('style')
<link href="{{ asset('Guest/custom/guest.rooms.css') }}" rel="stylesheet" type="text/css">
@endsection
@section('header')
<div class="container">
    <div class="row">
        <div class="col-lg-12 text-center">
            <div class="breadcrumb-text">
                <h2>About</h2>
                <div class="bt-option">
                    <a href="./home.html">Home</a>
                    <i class="fas fa-angle-right"></i>
                    <span>About</span>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('main')
<div class="container">
    <div class="row mb-4 mt-3">
        <div class="col-lg-6">
            @if (!empty($about->foto))
                <img src="{{ asset('img/about/' . $about->foto) }}" alt="About foto" class="img-fluid rounded">
            @endif
        </div>
        @if (!empty($about->about))
            <div class="col-lg-6 about">
                <h2 class="display-5">About Us</h2>
                <br>
                <p class="text-secondary"> {{ $about->about }} </p>
                <br>
            </div>
        @endif
    </div>
</div>
@endsection
