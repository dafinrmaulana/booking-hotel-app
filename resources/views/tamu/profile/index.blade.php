@extends('tamu.master-tamu')
@section('title')
Your Profile
@endsection
@section('style')
<link rel="stylesheet" href="{{ asset('Guest/custom/guest.rooms.css') }}">
@endsection
@section('header')
<div class="container">
    <div class="row">
        <div class="col-lg-12 text-center">
            <div class="breadcrumb-text">
                <h2>Your Profile</h2>
                <div class="bt-option">
                    <a href="/home">Home</a>
                    <i class="fas fa-angle-right"></i>
                    <span>Profile</span>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('main')
<div class="container">
    <div class="row justify-content-center mb-5 pb-5 mt-5">
        <div class="col-lg-6">
            <div class="card shadow">
                <div class="card-header border-0 bg-transparent">
                    <p class="font-weight-bold border-bottom">
                        Your information
                        <a href="{{ route('profile.edit') }}" class="text-dark" title="Edit Your Profile"><i class="fas fa-edit"></i></a>
                    </p>
                </div>
                <div class="container">
                    <div class="row pb-2">
                        <div class="col ml-1">
                            <p>Name</p>
                            <p class="font-weight-bold">{{ Auth::user()->nama_pemesan }}</p>
                        </div>
                        <div class="border-left ml-2 col ml-1">
                            <p>Email</p>
                            <p class="font-weight-bold">{{ Auth::user()->email }}</p>
                        </div>
                        <div class="border-left ml-2 col ml-1">
                            <p>Phone</p>
                            <p class="font-weight-bold">{{ Auth::user()->no_hp }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
