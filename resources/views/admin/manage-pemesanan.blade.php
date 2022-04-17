@extends('admin.master')
@section('title')
    RuangAdmin - Manage pemesanan
@endsection
@section('main')
    <x-breadcrumb title="Manage Pemesanan">
        <li class="breadcrumb-item"><a href="./">Dashboard</a></li>
        <li class="breadcrumb-item active" aria-current="page">Data Pemesanan</li>
    </x-breadcrumb>
    <!-- DataTable with Hover -->
    <div class="row">
        <div class="col-lg-12">
            <div class="card mb-4">

                <x-card-header>
                    <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#createModal">
                        <i class="fas fa-plus"></i> Tambah Pemesanan
                    </button>
                </x-card-header>

                <x-table-responsive>
                    <x-th>
                        <th>Nama Pemesan</th>
                        <th>Nama Kamar</th>
                        <th>Status</th>
                        <th>Tanggal Dipesan</th>
                        <th>Action</th>
                    </x-th>

                    <tbody>
                        @foreach ($pemesanan as $data)
                            <tr class="data">
                                <td>{{ $data->nama_pemesan }}</td>
                                <td>{{ $data->kamar->nama_kamar }}</td>
                                @if ($data->status_pemesan == 'checkout')
                                    <td><span class="badge badge-danger">{{ $data->status_pemesan }}</span></td>
                                @endif
                                @if ($data->status_pemesan == 'checkin')
                                    <td><span class="badge badge-success">{{ $data->status_pemesan }}</span></td>
                                @endif
                                @if ($data->status_pemesan == 'cancel')
                                    <td><span class="badge badge-warning">{{ $data->status_pemesan }}</span></td>
                                @endif
                                @if ($data->status_pemesan == 'unpaid')
                                    <td><span class="badge badge-secondary">{{ $data->status_pemesan }}</span></td>
                                @endif
                                <td>{{ date('Y-m-d', strtotime($data->tanggal_dipesan)) }}</td>
                                <td class="text-center">
                                    <a href="{{ route('manage-pemesanan.cetak', $data->id) }}" class="btn btn-info btn-sm">
                                         <i class="fas fa-print"></i>
                                    </a>

                                    <a href="#" class="btn btn-primary btn-detail btn-sm" title="Detail" data-id="{{ $data->id }}">
                                        <i class="fas fa-eye"></i>
                                    </a>

                                    <a href="{{ route('manage-pemesanan.edit', $data->id) }}" class="btn btn-sm btn-success btn-edit" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>

                                    <a href="#" class="btn-delete btn btn-danger btn-sm" data-id="{{ $data->id }}" title="Delete">
                                        <i class="fas fa-trash"></i>
                                        <form action="{{ route('manage-pemesanan.destroy', $data->id) }}"
                                            id="delete-pemesanan{{ $data->id }}" method="POST">
                                            @csrf
                                            @method('delete')
                                        </form>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </x-table-responsive>

            </div>
        </div>
    </div>

    {{-- modal create --}}
    <x-modal-parent id="createModal" ariaLabelledby="ModalCreate" modalSize="modal-lg">
        <x-modal-header titleHeader="Masukan data pemesan" idHeader="ModalCreate" />

        <x-modal-body>
            <x-form action="{{ route('manage-pemesanan.store') }}" id="" method="POST" bajak="post">
                <div class="row">
                    <x-modal-input class="col-6" value="{{ old('nama_pemesan') }}" name='nama_pemesan' label="Nama Pemesan" type="text" />
                    <x-modal-input class="col-6" value="{{ old('nama_tamu') }}" name='nama_tamu' label="Nama Tamu" type="text" />
                    <x-modal-input class="col-6" value="{{ old('email') }}" name='email' label="Email" type="email" />
                    <x-modal-input class="col-6" value="{{ old('no_hp') }}" name='no_hp' label="Nomor Hp pemesan" type="text" />
                    <x-modal-input class="col-6" value="{{ old('tanggal_checkin') }}" name='tanggal_checkin' label="Tanggal Check In" type="date" />
                    <x-modal-input class="col-6" value="{{ old('tanggal_checkout') }}" name='tanggal_checkout' label="Tanggal Check Out" type="date" />
                    <x-modal-input class="col-6" value="{{ old('jumlah_kamar_dipesan') }}" name='jumlah_kamar_dipesan' label="Jumlah kamar dipesan" type="text" />
                    <div class="form-group col-6">
                        <label for="nama_kamar">Nama Kamar</label>
                        <select class="form-control mb-3" name="kamar_id">
                            @foreach ($kamar as $item)
                                @if (old('kamar_id') == $item->id)
                                    <option value="{{ $item->id }}" selected="selected">{{ $item->nama_kamar }}
                                    </option>
                                @else
                                    <option value="{{ $item->id }}">{{ $item->nama_kamar }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="modal-footer col-12">
                    <x-button type="button" class="btn btn-outline-danger" desc="Batal" dataDismiss="modal" />
                    <x-button type="submit" class="btn btn-primary" desc="Simpan" dataDismiss="" />
                </div>
            </x-form>
        </x-modal-body>
    </x-modal-parent>

    {{-- modal detail --}}
    <x-modal-parent id="detailModal" ariaLabelledby="ModalDetail" modalSize="modal-lg">
        <x-modal-header idHeader="detailModal" titleHeader="Detail data pemesanan" />
        <div class="modal-body">
        </div>
    </x-modal-parent>
@endsection

@push('page-script')
    <script>
        $(document).ready(function() {
            $('#dataTable').DataTable(); // ID From dataTable
            $('#dataTableHover').DataTable(); // ID From dataTable with Hover

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

            // jumlah kamar dipesan
            $('#jumlah_kamar_dipesan').TouchSpin({
                min: 0,
                max: 99999,
                boostat: 5,
                maxboostedstep: 10,
                initval: 0
            });

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
                        $(`#delete-pemesanan${id}`).submit();
                    }
                })
            });

            // detail action
            $('.btn-detail').on('click', function() {
                let id = $(this).data('id')
                $.ajax({
                    url: `/admin/manage-pemesanan/${id}`,
                    method: "GET",
                    success: function(data) {
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
