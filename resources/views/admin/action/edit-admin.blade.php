@extends('admin.master')

@section('title')
    RuangAdmin - Edit admin
@endsection

@section('main')
    <x-breadcrumb title="Edit admin">
        <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('manage-admin.index') }}">Data Admin</a></li>
        <li class="breadcrumb-item active" aria-current="page">Edit admin</li>
    </x-breadcrumb>

    <div class="row">
        <div class="col-lg-7">
            <!-- Form Basic -->
            <div class="card mb-4">

                <x-card-header>
                    <h6 class="m-0 font-weight-bold text-primary">Form admin</h6>
                </x-card-header>

                <x-card-body>
                    <x-form action="{{ route('manage-admin.update', $data->id) }}" id="update-admin" method="POST"
                        bajak="put">
                        <div class="row">
                            <x-modal-input class="col-6" value="{{ old('nama', $data->nama) }}" name='nama' label="Nama Admin" type="text" />
                            <x-modal-input class="col-6" value="{{ old('username', $data->username) }}" name='username' label="Username" type="text" />
                            <x-password-input class="col-6" value="{{ old('password') }}" name='password' label="password" type="password" />
                            <x-modal-input class="col-6" value="{{ old('password_confirmation') }}" name='password_confirmation' label="password" type="password" />
                            <div class="form-group col-12">
                                <label for="Role">Role</label>
                                <select class="form-control mb-3" name="role">
                                    @if (old('role') == 'Admin')
                                        <option value="Admin" selected>Admin</option>
                                        <option value="resepsionis">Resepsionis</option>
                                    @elseif (old('role') == 'resepsionis')
                                        <option value="Admin">Admin</option>
                                        <option value="resepsionis" selected>Resepsionis</option>
                                    @else
                                        <option value="Admin">Admin</option>
                                        <option value="resepsionis">Resepsionis</option>
                                    @endif
                                </select>
                            </div>
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
                        $(`#update-admin`).submit();
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
                        window.location = `{{ route('manage-admin.index') }}`
                    }
                })
            });
        })
    </script>
@endpush
