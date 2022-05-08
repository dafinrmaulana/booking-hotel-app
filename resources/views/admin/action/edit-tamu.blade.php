@extends('admin.master')
@section('title')
    RuangAdmin - Edit tamu
@endsection
@section('main')
    <x-breadcrumb title="Edit tamu">
        <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('manage-tamu.index') }}">Data Tamu</a></li>
        <li class="breadcrumb-item active" aria-current="page">Edit Tamu</li>
    </x-breadcrumb>

    <div class="row">
        <div class="col-lg-7">

            <!-- Form Basic -->
            <div class="card mb-4">

                <x-card-header>
                    <h6 class="m-0 font-weight-bold text-primary">Form tamu</h6>
                </x-card-header>

                <x-card-body>
                    <x-form action="{{ route('manage-tamu.update', $data->id) }}" id="update-tamu" method="POST" bajak="put">
                        <div class="row">
                            <x-modal-input class="col-6" value="{{ old('nama_pemesan', $data->nama_pemesan) }}" name='nama' label="nama" type="text" />
                            <x-modal-input class="col-6" value="{{ old('email', $data->email) }}" name='email' label="Email" type="email" />
                            <x-modal-input class="col-6" value="{{ old('no_hp', $data->no_hp) }}" name='no_hp' label="Nomor Hp" type="text" />
                            <x-password-input class="col-6" />
                            <x-modal-input class="col-6" value="{{ old('password_confirmation') }}" name='password_confirmation' label="password" type="password" />
                        </div>
                        <a href="#" class="btn btn-outline-danger btn-batal">Batal</a>
                        <x-button type="button" class="btn btn-primary btn-update" desc="Simpan" dataDismiss="" />
                    </x-form>
                </x-card-body>
            </div>
        </div>
    </div>
@endsection

@push('page-script')
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

            // update======
            $('.btn-update').click(function(e) {
                e.preventDefault();
                var id = $(this).data('id');
                Swal.fire({
                    title: 'Yakin Ubah data?',
                    text: "Pastiin dulu data yang kamu masukin udah bener",
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yakin Dong!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $(`#update-tamu`).submit();
                    }
                })
            });

            // batal
            $('.btn-batal').click(function(e) {
                e.preventDefault();
                var id = $(this).data('id');
                Swal.fire({
                    title: 'Yakin batal ?',
                    text: "Data yang udah kamu ubah bakal ilang loh?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yakin banget'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location = `{{ route('manage-tamu.index') }}`
                    }
                })
            });
        })
    </script>
@endpush
