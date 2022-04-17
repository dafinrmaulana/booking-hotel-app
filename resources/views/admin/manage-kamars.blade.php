@extends('admin.master')
@section('title')
    RuangAdmin - Manage Kamar
@endsection
@section('main')
    <x-breadcrumb title="Manage kamar">
        <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Dashboard</a></li>
        <li class="breadcrumb-item active" aria-current="page">Data Kamar</li>
    </x-breadcrumb>

    <div class="row">
        <div class="col-lg-12 mb-4">
            <!-- Simple Tables -->
            <div class="card px-3">

                {{-- card header --}}
                <x-card-header>
                    <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#createModal">
                        <i class="fas fa-plus"></i> Tambah kamar
                    </button>
                    <form action="{{ route('search.kamar') }}" method="get">
                        @csrf
                        <div class="row g-3 align-items-center">
                            <div class="col-auto">
                                <label for="search" class="col-form-label">search : </label>
                            </div>
                            <div class="col-8">
                                <input type="search" id="search" name="search" class="form-control"
                                    placeholder="cari nama.." aria-describedby="searchHelpInline" style="height: 30px">
                            </div>
                        </div>
                    </form>
                </x-card-header>

                {{-- table --}}
                <div class="table-responsive">
                    <table class="table align-items-center table-flush">
                        <x-th>
                            <th>No</th>
                            <th>Nama Kamar</th>
                            <th>Harga</th>
                            <th>Jumlah</th>
                            <th class="text-center">Foto</th>
                            <th class="text-center">Action</th>
                        </x-th>
                        <tbody>
                            @forelse ($kamar as $data)
                                <tr>
                                    <td>{{ $loop->index += 1 }}</td>
                                    <td>{{ $data->nama_kamar }}</td>
                                    <td>Rp. {{ number_format($data->harga, 2, '.', '.') }}</td>
                                    <td>{{ $data->jumlah }} kamar</td>

                                    @if ($data->foto == null)
                                        <td class="text-center">
                                            <img style="cursor: pointer"
                                            data-fancybox data-src
                                            src="https://upload.wikimedia.org/wikipedia/commons/d/d1/Image_not_available.png"
                                            alt="foto kamar" width="70">
                                        </td>
                                    @endif
                                    @if ($data->foto)
                                        <td class="text-center">
                                            <img style="cursor: pointer"
                                            data-fancybox data-src
                                            src="{{ asset('img/kamar/' . $data->foto) }}"
                                            alt="foto kamar" width="70">
                                        </td>
                                    @endif

                                    <td class="text-center">
                                        <a href="#" class="btn btn-sm btn-primary btn-detail"
                                        data-id="{{ $data->id }}"
                                        title="Detail">
                                            <i class="fas fa-eye"></i>
                                        </a>

                                        <a href="{{ route('manage-kamar.edit', $data->id) }}"
                                        class="btn btn-sm btn-success btn-edit"
                                        title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>

                                        <a href="#" class="btn-delete btn btn-danger btn-sm"
                                        data-id="{{ $data->id }}"
                                        title="Delete">
                                            <i class="fas fa-trash"></i>
                                            <form action="{{ route('manage-kamar.destroy', $data->id) }}"
                                                id="delete-kamar{{ $data->id }}" method="POST">
                                                @csrf
                                                @method('delete')
                                            </form>
                                        </a>
                                    </td>

                                </tr>
                            @empty
                        </tbody>
                    </table>
                    <div class="text-center">
                        <img src="{{ asset('RA/img/nf.gif') }}" style="max-height: 100px;" class="mb-3">
                        <h3 class="text-gray-800 font-weight-bold">Oopss!</h3>
                        <p class="lead text-gray-800 mx-auto">Tidak ada satupun data yang ditemukan</p>
                        <a href="{{ route('manage-kamar.index') }}">&larr; Back to Kamar</a>
                    </div>
                    @endforelse
                    </tbody>
                    </table>
                </div>

                {{-- footer --}}
                <div class="card-footer">
                    {{ $kamar->links() }}
                </div>
            </div>
        </div>
    </div>

    {{-- modal detail --}}
    <x-modal-parent id="detailModal" ariaLabelledby="ModalDetail" modalSize="modal-lg">
        <x-modal-header idHeader="detailModal" titleHeader="Detail data Kamar" />
        <div class="modal-body">
        </div>
    </x-modal-parent>

    {{-- modal create --}}
    <x-modal-parent id="createModal" ariaLabelledby="ModalCreate" modalSize="modal-lg">
        <x-modal-header titleHeader="Masukan data kamar" idHeader="ModalCreate" />
        <x-modal-body>
            <x-form action="{{ route('manage-kamar.store') }}" id="" method="POST" bajak="post">
                <div class="row">
                    <x-modal-input class="col-6" value="{{ old('nama_kamar') }}" name='nama_kamar' label="Nama Kamar" type="text" />
                    <x-modal-input class="col-6" value="{{ old('jumlah') }}" name='jumlah' label="Jumlah kamar" type="text" />
                    <x-harga-modal-input class="col-6" value="{{ old('harga') }}" label="harga" name="harga" placeholder="500.000" />
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
                            id="keterangan" rows="3">{{ old('keterangan') }}</textarea>
                        @error('keterangan')
                            <small id="keterangan" class="form-text text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="modal-footer col-12">
                        <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </div>
            </x-form>
        </x-modal-body>
    </x-modal-parent>
@endsection
@push('page-script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>
<script>
    $(document).ready(function() {

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
        $('select').selectpicker();

        // jumlah kamar
        $('#jumlah').TouchSpin({
            min: 0,
            max: 99999,
            boostat: 5,
            maxboostedstep: 10,
            initval: 0
        });

        // store message
        @if (session()->has('store'))
            const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3500,
            timerProgressBar: true,
            didOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
            })

            Toast.fire({
            icon: 'success',
            title: 'Sukses! Data berhasil ditambahkan'
            })
        @endif

        // delete message
        @if (session()->has('delete'))
            const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3500,
            timerProgressBar: true,
            didOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
            })

            Toast.fire({
            icon: 'success',
            title: 'Oke data berhasil di hapus'
            })
        @endif

        // update message
        @if (session()->has('update'))
            const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3500,
            timerProgressBar: true,
            didOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
            })

            Toast.fire({
            icon: 'success',
            title: 'Sip data berhasil di ubah'
            })
        @endif

        // delete action
        $('.btn-delete').click(function(e) {
            e.preventDefault();
            var id = $(this).data('id');
            Swal.fire({
                title: 'Yakin hapus data?',
                text: "Data yang kamu hapus ga bakal balik lagi",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yakin, Hapus aja!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $(`#delete-kamar${id}`).submit();
                }
            })
        });

        // detail action
        $('.btn-detail').on('click', function() {
            let id = $(this).data('id')
            $.ajax({
                url: `/admin/manage-kamar/${id}`,
                method: "GET",
                success: function(data) {
                    //  console.log(data)
                    $("#detailModal").find(".modal-body").html(data)
                    $("#detailModal").modal('show')
                },
                error: function(error) {
                    console.log(error)
                }
            })
        });
    });
</script>
@endpush
