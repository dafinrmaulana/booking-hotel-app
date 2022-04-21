@extends('tamu.master-tamu')
@section('title')
    verify your email
@endsection
@section('style')
    <link href="{{ asset('Guest/custom/guest.rooms.css') }}" rel="stylesheet" type="text/css">
@endsection
@section('main')
<div class="container-fluid">
	<div class="row justify-content-center card-verify py-5 align-items-center">
		<div class="col-lg-10">
			<div class="row justify-content-center p-5">
				<div class="col-lg-8">
                    <div class="card p-5 shadow-lg bg-secondary">
					<p class="text-lowercase text-light">Hi, {{ auth()->user()->nama_tamu }} We have sent you a link verification email to
                    {{ auth()->user()->email }} please check your inboxes then you can access all of
                    web features</p>
                    <a href="{{ route('verification.send') }}" class="text-capitalize text-light">email verification deleted? Resend the verification link here</a>
                    </div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
