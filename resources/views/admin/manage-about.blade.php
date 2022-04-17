@extends('admin.master')
@section('title')
    KetaksaanAdmin - Manage About
@endsection
@section('main')
<x-breadcrumb title="Manage About">
    <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Dashboard</a></li>
    <li class="breadcrumb-item active" aria-current="page">Data About</li>
</x-breadcrumb>

<div class="row">
    <div class="col-lg-12 mb-4">
        <!-- Simple Tables -->
        <div class="card px-3">

            {{-- card header --}}
            <x-card-header>
                @if (empty($about[0]))
                <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#createModal">
                    <i class="fas fa-plus"></i> Tambah About
                </button>
                @endif
            </x-card-header>

            {{-- table --}}
            <div class="table-responsive">
                <table class="table align-items-center table-flush">
                    <x-th>
                        <th>About</th>
                        <th class="text-center">Foto</th>
                        <th class="text-center">Action</th>
                    </x-th>
                    <tbody>
                        @forelse ($about as $data)
                            <tr>
                                <td>{{ Str::limit($data->about, 70) }}</td>

                                @if ($data->foto == null)
                                    <td class="text-center">
                                        <img style="cursor: pointer"
                                        data-fancybox data-src
                                        src="https://upload.wikimedia.org/wikipedia/commons/d/d1/Image_not_available.png"
                                        alt="foto about" width="70">
                                    </td>
                                @endif
                                @if ($data->foto)
                                    <td class="text-center">
                                        <img style="cursor: pointer"
                                        data-fancybox data-src
                                        src="{{ asset('img/about/' . $data->foto) }}"
                                        alt="foto about" width="70">
                                    </td>
                                @endif

                                <td class="text-center">
                                    <a href="#" class="btn btn-sm btn-primary btn-detail"
                                    data-id="{{ $data->id }}"
                                    title="Detail">
                                        <i class="fas fa-eye"></i>
                                    </a>

                                    <a href="{{ route('manage-about.edit', $data->id) }}"
                                    class="btn btn-sm btn-success btn-edit"
                                    title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>

                                    <a href="#" class="btn-delete btn btn-danger btn-sm"
                                    data-id="{{ $data->id }}"
                                    title="Delete">
                                        <i class="fas fa-trash"></i>
                                        <form action="{{ route('manage-about.destroy', $data->id) }}"
                                            id="delete-about{{ $data->id }}" method="POST">
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
                    <a href="{{ route('manage-about.index') }}">&larr; Back to Manage About</a>
                </div>
                @endforelse
                </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

{{-- create --}}
<x-modal-parent id="createModal" ariaLabelledby="ModalCreate" modalSize="">
    <x-modal-header titleHeader="Masukan data about" idHeader="ModalCreate" />
    <x-modal-body>
        <x-form action="{{ route('manage-about.store') }}" id="" method="POST" bajak="post">
            <div class="row">
                <div class="form-group col-12">
                    <label for="about">about</label>
                    <textarea
                    class="form-control" @error('about')
                    style="border: 1px solid red" @enderror name="about"
                    id="about"
                    rows="8">{{ old('about') }}</textarea>

                    @error('about')
                        <small id="about" class="form-text text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <x-modal-input class="col-12" value="{{ old('foto') }}" name='foto' label="Foto about" type="file" />

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
    <x-modal-header idHeader="detailModal" titleHeader="Detail data Kamar" />
    <div class="modal-body">
    </div>
</x-modal-parent>
@endsection

@push('page-script')
<script>
    $(document).ready(function() {
        // detail action
        $('.btn-detail').on('click', function() {
            let id = $(this).data('id')
            $.ajax({
                url: `/admin/manage-about/${id}`,
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

        $('.btn-delete').click(function(e) {
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
                        $(`#delete-about${id}`).submit();
                    }
                })
            });

    });
</script>
@endpush
