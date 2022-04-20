@extends('admin.master')
@section('title')
KetaksaanAdmin - Manage Fasilitas Hotel
@endsection
@section('main')
<x-breadcrumb title="Manage fasilitas hotel">
    <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Dashboard</a></li>
    <li class="breadcrumb-item active" aria-current="page">Data Fasilitas hotel</li>
</x-breadcrumb>

<div class="row">
    <div class="col-lg-12 mb-4">
        <!-- Simple Tables -->
        <div class="card px-3">

            {{-- card header --}}
            <x-card-header>
                <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#createModal">
                    <i class="fas fa-plus"></i> Tambah fasilitas Hotel
                </button>
                <form action="{{ route('search.fasilitasHotel') }}" method="get">
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
                        <th>Nama fasilitas</th>
                        <th>Foto</th>
                        <th class="text-center">Action</th>
                    </x-th>

                    <tbody>
                    @forelse ($fasilitas as $data)
                        <tr>
                            <td>{{ $loop->index += 1 }}</td>
                            <td>{{ $data->nama_fasilitas_hotel }}</td>
                            @if ($data->foto == null)
                                <td class="text-center">
                                    <img style="cursor: pointer"
                                    data-fancybox data-src
                                    src="https://upload.wikimedia.org/wikipedia/commons/d/d1/Image_not_available.png"
                                    alt="foto hotel" width="70">
                                </td>
                            @endif
                            @if ($data->foto)
                                <td class="text-center">
                                    <img style="cursor: pointer"
                                    data-fancybox data-src
                                    src="{{ asset('img/fasilitasHotel/' . $data->foto) }}"
                                    alt="foto hotel" width="70">
                                </td>
                            @endif

                            <td class="text-center">
                                <a href="#"
                                class="btn btn-sm btn-primary btn-detail"
                                data-id="{{ $data->id }}"
                                title="Detail">
                                    <i class="fas fa-eye"></i>
                                </a>

                                <a href="{{ route('manage-fasilitas-hotel.edit', $data->id) }}"
                                class="btn btn-sm btn-success btn-edit"
                                title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>

                                <a href="#"
                                class="btn-delete btn btn-danger btn-sm"
                                data-id="{{ $data->id }}"
                                title="Delete">
                                    <i class="fas fa-trash"></i>
                                    <form action="{{ route('manage-fasilitas-hotel.destroy', $data->id) }}"
                                        id="delete-fasilitasHotel{{ $data->id }}" method="POST">
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
                            <a href="{{ route('manage-fasilitas-hotel.index') }}">&larr; Kembali ke Manage fasilitas hotel</a>
                        </div>
                    @endforelse
                    </tbody>
                </table>
            </div>

            {{-- footer --}}
            <div class="card-footer">
                {{ $fasilitas->links() }}
            </div>


        </div>
    </div>
</div>

{{-- create modal --}}
<x-modal-parent id="createModal" ariaLabelledby="ModalCreate" modalSize="">
    <x-modal-header titleHeader="Masukan data fasilitas hotel" idHeader="ModalCreate" />
    <x-modal-body>
        <x-form action="{{ route('manage-fasilitas-hotel.store') }}" id="" method="POST" bajak="post">
            <div class="row">
                <x-modal-input class="col-12" value="{{ old('nama_fasilitas_hotel') }}" name='nama_fasilitas_hotel' label="Nama Fasilitas Hotel" type="text" />
                <x-modal-input class="col-12" value="" name='foto' label="Foto Fasilitas Hotel" type="file" />
                <div class="form-group col-12">
                    <label for="keterangan">Keterangan</label>
                    <textarea class="form-control"
                    @error('keterangan') style="border: 1px solid red" @enderror
                    name="keterangan"
                    id="keterangan"
                    rows="3"> {{ old('keterangan') }}</textarea>
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


{{-- modal detail --}}
<x-modal-parent id="detailModal" ariaLabelledby="ModalDetail" modalSize="modal-lg">
    <x-modal-header idHeader="detailModal" titleHeader="Detail data fasilitas hotel" />
    <div class="modal-body">
    </div>
</x-modal-parent>

@endsection
@push('page-script')
<script>
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
                $(`#delete-fasilitasHotel${id}`).submit();
            }
        })
    });

    // detail action
    $('.btn-detail').on('click', function() {
        let id = $(this).data('id')
        $.ajax({
            url: `/admin/manage-fasilitas-hotel/${id}`,
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
</script>
@endpush

