@extends('admin.master')
@section('title')
KetaksaanAdmin - Edit fasilitas hotel
@endsection
@section('main')
<x-breadcrumb title="Manage Fasilitas Hotel">
    <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('manage-fasilitas-hotel.index') }}">Data Fasilitas hotel</a></li>
    <li class="breadcrumb-item active" aria-current="page">edit fasilitas hotel</li>
</x-breadcrumb>

<div class="row">
    <div class="col-lg-7">
        <!-- Form Basic -->
        <div class="card mb-4">

            <x-card-header>
                <h6 class="m-0 font-weight-bold text-primary">Form fasilitas hotel</h6>
            </x-card-header>

            <x-card-body>
                <x-form action="{{ route('manage-fasilitas-hotel.update', $data->id) }}" id="update-fasilitas-hotel" method="POST"
                    bajak="put">
                    <div class="row">
                        <x-modal-input class="col-12"
                        value="{{ old('nama_fasilitas_hotel', $data->nama_fasilitas_hotel) }}"
                        name='nama_fasilitas_hotel' label="Nama Fasilitas Hotel" type="text" />
                        <x-modal-input class="col-12" value="" name='foto' label="Foto Fasilitas Hotel" type="file" />
                        <div class="form-group col-12">
                            <label for="keterangan">Keterangan</label>
                            <textarea class="form-control"
                            @error('keterangan') style="border: 1px solid red" @enderror
                            name="keterangan"
                            id="keterangan"
                            rows="3"> {{ old('keterangan', $data->keterangan) }}</textarea>
                            @error('keterangan')
                            <small id="keterangan" class="form-text text-danger">{{ $message }}</small>
                            @enderror
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
                $(`#update-fasilitas-hotel`).submit();
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
                window.location = `{{ route('manage-fasilitas-hotel.index') }}`
            }
        })
    });
});
</script>
@endpush
