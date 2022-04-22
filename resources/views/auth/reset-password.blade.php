@extends('tamu.master-tamu')
@section('title')
    Reset password
@endsection
@section('style')
<link href="{{ asset('Guest/custom/guest.rooms.css') }}" rel="stylesheet" type="text/css">
@endsection
@section('header')
<div class="container">
    <div class="row">
        <div class="col-lg-12 text-center">
            <div class="breadcrumb-text">
                <h2>Forgot Password</h2>
                <div class="bt-option">
                    <a href="./home.html">Home</a>
                    <i class="fas fa-angle-right"></i>
                    <span>Forgot Password</span>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('main')
<div class="container">
	<div class="row justify-content-center mt-3 mb-5">
        <div class="col-10 mb-4">
            <div class="row justify-content-center">
                <div class="col-7 p-5">
                    <div class="card border-0 shadow-lg">

                        <div class="text-center mb-4 pt-3">
                            <h1 class="h4 text-gray-900">Reset password</h1>
                            <small>Enter your new password</small>
                        </div>

                        @if (session()->has('status'))
                        <small>{{ session('status') }}</small>
                        @endif
                        <div class="card-body">
                            <form class="user" action="{{ route('password.update') }}" method="post">
                                @csrf

                                <input type="hidden" name="token" value="{{ $token }}">
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon2">
                                            <i class="fas fa-envelope"></i>
                                            </span>
                                        </div>
                                        <input type="email"
                                        name="email"
                                        value="{{ old('email') }}"
                                        class="form-control @error('email') is-invalid @enderror"
                                        id="email" aria-describedby="email"
                                        placeholder="Enter email">
                                    </div>
                                    @error('email')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <div class="input-group">
                                        <input type="password" name="password"
                                            class="form-control @error('password') is-invalid @enderror" id="password"
                                            placeholder="Enter password" aria-describedby="basic-addon2">
                                        <div class="input-group-append show-trigger-2">
                                            <span class="input-group-text" id="basic-addon2">
                                                <i class="fas fa-eye d-none" id="hide_eye_regist"></i>
                                                <i class="fas fa-eye-slash" id="show_eye_regist"></i>
                                            </span>
                                        </div>
                                    </div>
                                    @error('password')
                                    <small class="text-danger message-pass-regis">{{ $message }}</small>
                                    @enderror
                                  </div>

                                  <div class="form-group">
                                    <div class="input-group mb-3">
                                        <input type="password" name="password_confirmation"
                                            class="form-control @error('password') is-invalid @enderror" id="password"
                                            placeholder="Confirm the password" aria-describedby="basic-addon2">
                                    </div>
                                  </div>

                                <div class="form-group">
                                  <button type="submit" class="btn btn-dark btn-block">Reset</button>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>
	</div>
</div>
@endsection
