@extends('admin.master')
@section('title')
    RuangAdmin - Ubah data Kamar
@endsection
@section('main')
<<<<<<< HEAD
    <x-breadcrumb title="Manage tamu">
=======
    <x-breadcrumb title="Edit kamar">
>>>>>>> 7782819007e372ce748b0bdd092c628d1a01019d
        <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('manage-kamar.index') }}">Data Kamar</a></li>
        <li class="breadcrumb-item active" aria-current="page">Edit Kamar</li>
    </x-breadcrumb>

    <div class="row">
        <div class="col-lg-7">
            <!-- Form Basic -->
            <div class="card mb-4">

                <x-card-header>
                    <h6 class="m-0 font-weight-bold text-primary">Form Kamar</h6>
                </x-card-header>

                <div class="card-body">
                    <x-form action="{{ route('manage-kamar.update', $data->id) }}" id="update-kamar" method="POST" bajak="put">
                        <div class="row">
                            <x-modal-input class="col-6" value="{{ old('nama_kamar', $data->nama_kamar) }}" name='nama_kamar' label="Nama Kamar" type="text" />
                            <x-modal-input class="col-6" value="{{ old('jumlah', $data->jumlah) }}" name='jumlah' label="Jumlah kamar" type="text" />
                            <x-harga-modal-input class="col-6" value="{{ old('harga', $data->harga) }}" label="harga" name="harga" placeholder="500.000" />
                            <x-modal-input class="col-6" value="{{ old('foto') }}" name='foto' label="Foto kamar" type="file" />
                            <div class="form-group col-12">
                                <label for="fasilitas">Fasilitas</label>
                                <select name="fasilitasKamar_id[]" multiple class="selectpicker col-12 @error('fasilitasKamar_id') is-invalid @enderror">
                                    @foreach ($fasilitas as $items)
                                        @if (old('fasilitasKamar_id[]') == $items->id )
                                            <option value="{{ $items->id }}" selected="selected">{{ $items->nama_fasilitas }}</option>
                                        @else
                                            <option value="{{ $items->id }}">{{ $items->nama_fasilitas }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-12">
                                <label for="keterangan">Keterangan</label>
                                <textarea class="form-control" @error('keterangan') style="border: 1px solid red" @enderror name="keterangan"
<<<<<<< HEAD
                                    id="keterangan" rows="3">{{ old('keterangan') }}</textarea>
=======
                                    id="keterangan" rows="3">{{ old('keterangan', $data->keterangan) }}</textarea>
>>>>>>> 7782819007e372ce748b0bdd092c628d1a01019d
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
<<<<<<< HEAD
    <script>
        $(document).ready(function() {

=======
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>
    <script>
        $(document).ready(function() {

            $('select').selectpicker();

>>>>>>> 7782819007e372ce748b0bdd092c628d1a01019d
            // Harga kamar ==================
            function setInputFilter(textbox, inputFilter) {
                ["input", "keydown", "keyup", "mousedown", "mouseup", "select", "contextmenu", "drop"].forEach(
                    function(event) {
                        textbox.addEventListener(event, function() {
                            if (inputFilter(this.value)) {
                                this.oldValue = this.value;
                                this.oldSelectionStart = this.selectionStart;
                                this.oldSelectionEnd = this.selectionEnd;
                            } else if (this.hasOwnProperty("oldValue")) {
                                this.value = this.oldValue;
                                this.setSelectionRange(this.oldSelectionStart, this.oldSelectionEnd);
                            } else {
                                this.value = "";
                            }
                        });
                    });
            }
            setInputFilter(document.getElementById("jumlah"), function(value) {
                return /^\d*\.?\d*$/.test(value); // Allow digits and '.' only, using a RegExp
            });
            setInputFilter(document.getElementById("harga"), function(value) {
                return /^\d*\.?\d*$/.test(value); // Allow digits and '.' only, using a RegExp
            });

            $('#jumlah').TouchSpin({
                min: 0,
                max: 99999,
                boostat: 5,
                maxboostedstep: 10,
                initval: 0
            });

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
                        $(`#update-kamar`).submit();
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
                    window.location = `{{ route('manage-kamar.index') }}`
                    }
                })
            });
        })
    </script>
@endpush
