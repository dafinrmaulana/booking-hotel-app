@extends('admin.master')

@section('title')
    RuangAdmin - Edit admin
@endsection

@section('main')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Edit fasilitas kamar</h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('manage-fasilitas-kamar.index') }}">Manage fasilitas kamar</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">Edit fasilitas kamar</li>
        </ol>
    </div>

    <div class="row">
        <div class="col-lg-5">
            <!-- Form Basic -->
            <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Form fasilitas kamar</h6>
                </div>
                <div class="card-body">
                    <x-form action="{{ route('manage-fasilitas-kamar.update', $data->id) }}" id="update-fasilitas" method="POST" bajak="put">
                        <div class="row">
                            <x-modal-input class="col-12"
                                value="{{ old('nama_fasilitas', $data->nama_fasilitas) }}" name='nama_fasilitas'
                                label="Nama Fasilitas" type="text" />

                            <div class="form-group col-12">
                                <label for="keterangan">Keterangan</label>
                                <textarea class="form-control" @error('keterangan') style="border: 1px solid red" @enderror name="keterangan"
                                    id="keterangan" rows="3">{{ old('keterangan', $data->keterangan) }}</textarea>
                                @error('keterangan')
                                    <small id="keterangan" class="form-text text-danger">{{ $message }}</small>
                                @enderror
                            </div>
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
    <script>
        $(document).ready(function() {
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
                        $(`#update-fasilitas`).submit();
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
                        window.location = `{{ route('manage-fasilitas-kamar.index') }}`
                    }
                })
            });
        })
    </script>
@endpush
