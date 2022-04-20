@extends('admin.master')
@section('title')
    RuangAdmin - Edit Pemesanan
@endsection
@section('main')
    <x-breadcrumb title="Manage Pemesanan">
<<<<<<< HEAD
        <li class="breadcrumb-item"><a href="./">Home</a></li>
        <li class="breadcrumb-item">Tables</li>
        <li class="breadcrumb-item active" aria-current="page">Manage Pemesanan</li>
=======
        <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('manage-pemesanan.index') }}">Data pemesanan</a></li>
        <li class="breadcrumb-item active" aria-current="page">edit Pemesanan</li>
>>>>>>> 7782819007e372ce748b0bdd092c628d1a01019d
    </x-breadcrumb>

    <div class="row">
        <div class="col-lg-7">
            <!-- Form Basic -->
            <div class="card mb-4">
<<<<<<< HEAD
                
=======

>>>>>>> 7782819007e372ce748b0bdd092c628d1a01019d
                <x-card-header>
                    <h6 class="m-0 font-weight-bold text-primary">Form pemesanan</h6>
                </x-card-header>

                <x-card-body>
                    <x-form action="{{ route('manage-pemesanan.update', $data->id) }}" id="update-pemesanan" method="POST"
                        bajak="put">
                        <div class="row">
<<<<<<< HEAD
                            <x-modal-input value="{{ old('nama_pemesan', $data->nama_pemesan) }}" name='nama_pemesan'
                                label="Nama Pemesan" type="text" />
                            <x-modal-input value="{{ old('nama_tamu', $data->nama_tamu) }}" name='nama_tamu'
                                label="Nama Tamu" type="text" />
                            <x-modal-input value="{{ old('email', $data->email) }}" name='email' label="Email"
                                type="email" />
                            <x-modal-input value="{{ old('no_hp', $data->no_hp) }}" name='no_hp' label="Nomor Hp pemesan"
                                type="text" />
                            <x-modal-input value="{{ old('tanggal_checkin', $data->tanggal_checkin) }}"
                                name='tanggal_checkin' label="Tanggal Check In" type="date" />
                            <x-modal-input value="{{ old('tanggal_checkout', $data->tanggal_checkout) }}"
                                name='tanggal_checkout' label="Tanggal Check Out" type="date" />
                            <x-modal-input value="{{ old('jumlah_kamar_dipesan', $data->jumlah_kamar_dipesan) }}"
=======
                            <x-modal-input class="col-6" value="{{ old('nama_pemesan', $data->nama_pemesan) }}" name='nama_pemesan'
                                label="Nama Pemesan" type="text" />
                            <x-modal-input class="col-6" value="{{ old('nama_tamu', $data->nama_tamu) }}" name='nama_tamu'
                                label="Nama Tamu" type="text" />
                            <x-modal-input class="col-6" value="{{ old('email', $data->email) }}" name='email' label="Email"
                                type="email" />
                            <x-modal-input class="col-6" value="{{ old('no_hp', $data->no_hp) }}" name='no_hp' label="Nomor Hp pemesan"
                                type="text" />
                            <x-modal-input class="col-6" value="{{ old('tanggal_checkin', $data->tanggal_checkin) }}"
                                name='tanggal_checkin' label="Tanggal Check In" type="date" />
                            <x-modal-input class="col-6" value="{{ old('tanggal_checkout', $data->tanggal_checkout) }}"
                                name='tanggal_checkout' label="Tanggal Check Out" type="date" />
                            <x-modal-input class="col-6" value="{{ old('jumlah_kamar_dipesan', $data->jumlah_kamar_dipesan) }}"
>>>>>>> 7782819007e372ce748b0bdd092c628d1a01019d
                                name='jumlah_kamar_dipesan' label="Jumlah kamar dipesan" type="text" />
                            <div class="form-group col-6">
                                <label for="nama_kamar">Nama Kamar</label>
                                <select class="form-control mb-3" name="kamar_id">
                                    @foreach ($kamar as $item)
                                        @if (old('kamar_id') == $item->id)
                                            <option value="{{ $item->id }}" selected="selected">
                                                {{ $item->nama_kamar }}</option>
                                        @else
                                            <option value="{{ $item->id }}">{{ $item->nama_kamar }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-12">
                                <label for="nama_kamar">Status</label>
                                <select name="status" class="form-control form-control-sm">
                                    @if ($data->status_pemesan == 'unpaid')
                                        <option value="cancel">Cancel</option>
                                        <option value="checkin" selected> Check IN</option>
                                    @endif
                                    @if ($data->status_pemesan == 'checkin')
                                        <option value="checkout"> Check OUT</option>
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

            // jumlah kamar dipesan
            $('#jumlah_kamar_dipesan').TouchSpin({
                min: 0,
                max: 99999,
                boostat: 5,
                maxboostedstep: 10,
                initval: 0
            });

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
            setInputFilter(document.getElementById("jumlah_kamar_dipesan"), function(value) {
                return /^\d*\.?\d*$/.test(value); // Allow digits and '.' only, using a RegExp
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
                        $(`#update-pemesanan`).submit();
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
                        window.location = `{{ route('manage-pemesanan.index') }}`
                    }
                })
            });
        })
    </script>
@endpush
