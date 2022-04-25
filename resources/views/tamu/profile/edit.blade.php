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
                        Update Your Information
                    </p>
                </div>
                <div class="container">
                    <form action="{{ route('profile.update') }}">
                    @csrf
                    <div class="row pb-2">

                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-user-alt"></i></span>
                                    </div>

                                    <input type="text"
                                    class="form-control @error('nama_pemesan') is-invalid @enderror"
                                    placeholder="Your name"
                                    value="{{ old('nama_pemesan', Auth::user()->nama_pemesan) }}"
                                    name="nama_pemesan"
                                    aria-label="Guest Name"
                                    aria-describedby="basic-addon1">
                                </div>
                                @error('nama_pemesan')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="name">Email</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-envelope"></i></span>
                                    </div>

                                    <input type="text"
                                    class="form-control @error('email') is-invalid @enderror"
                                    placeholder="Your email"
                                    value="{{ old('email', Auth::user()->email) }}"
                                    name="email"
                                    aria-label="Guest Name"
                                    aria-describedby="basic-addon1">
                                </div>
                                @error('email')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label for="name">Phone</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-phone"></i></span>
                                    </div>

                                    <input type="text"
                                    class="form-control @error('nama_pemesan') is-invalid @enderror"
                                    placeholder="Your Phone Number"
                                    value="{{ old('no_hp', Auth::user()->no_hp) }}"
                                    name="no_hp"
                                    aria-label="Guest Name"
                                    aria-describedby="basic-addon1">
                                </div>
                                @error('no_hp')
                                <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                        <div class="col-lg-12">
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
