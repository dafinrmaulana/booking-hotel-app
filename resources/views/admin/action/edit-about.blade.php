@extends('admin.master')
@section('title')
    RuangAdmin - Ubah data About
@endsection
@section('main')
    <x-breadcrumb title="Edit about">
        <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('manage-about.index') }}">Data about</a></li>
        <li class="breadcrumb-item active" aria-current="page">Edit about</li>
    </x-breadcrumb>

    <div class="row">
        <div class="col-lg-7">
            <!-- Form Basic -->
            <div class="card mb-4">

                <x-card-header>
                    <h6 class="m-0 font-weight-bold text-primary">Form About</h6>
                </x-card-header>

                <div class="card-body">
                    <x-form action="{{ route('manage-about.update', $data->id) }}" id="update-about" method="POST" bajak="put">
                        <div class="row">
                            <div class="form-group col-12">
                                <label for="about">About</label>
                                <textarea class="form-control" @error('about') style="border: 1px solid red" @enderror name="about"
                                    id="about" rows="7">{{ old('about', $data->about) }}</textarea>
                                @error('about')
                                    <small id="about" class="form-text text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <x-modal-input class="col-12" value="{{ old('foto') }}" name='foto' label="Foto kamar" type="file" />
                        </div>
                        <a href="#" class="btn btn-outline-danger btn-batal">Batal</a>
                        <x-button type="button" class="btn btn-primary btn-update" desc="Simpan" dataDismiss="" />
                    </x-form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('page-script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>
    <script>
        $(document).ready(function() {

            // // update======
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
                        $(`#update-about`).submit();
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
                    window.location = `{{ route('manage-about.index') }}`
                    }
                })
            });
        })
    </script>
@endpush
