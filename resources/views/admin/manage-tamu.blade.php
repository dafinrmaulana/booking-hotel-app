@extends('admin.master')
@section('title')
    RuangAdmin - Manage Tamu
@endsection
@section('main')
    <x-breadcrumb title="Manage tamu">
        <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">Dashboard</a></li>
        <li class="breadcrumb-item active" aria-current="page">Data Tamu</li>
    </x-breadcrumb>

    <div class="row">
        <div class="col-lg-12 mb-4">
            <!-- Simple Tables -->
            <div class="card px-3">

                {{-- card header --}}
                <x-card-header>
                    <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#createModal">
                        <i class="fas fa-plus"></i> Tambah Akun tamu
                    </button>
                    <form action="{{ route('search.tamu') }}" method="get">
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
                            <th>email</th>
                            <th class="text-center">Action</th>
                        </x-th>

                        <tbody>
                            @forelse ($tamu as $data)
                                <tr>
                                    <td>{{ $loop->index += 1 }}</td>
                                    <td>{{ $data->email }}</td>
                                    <td class="text-center">
                                        <a href="#" class="btn btn-sm btn-primary btn-detail" data-id="{{ $data->id }}" id="modalCenter" title="Detail">
                                            <i class="fas fa-eye"></i>
                                        </a>

                                        <a href="{{ route('manage-tamu.edit', $data->id) }}" class="btn btn-sm btn-success btn-edit" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>

                                        <a href="#" class="btn-delete btn btn-danger btn-sm" data-id="{{ $data->id }}" title="Delete">
                                            <i class="fas fa-trash"></i>
                                            <form action="{{ route('manage-tamu.destroy', $data->id) }}"
                                                id="delete-tamu{{ $data->id }}" method="POST">
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
                            <a href="{{ route('manage-tamu.index') }}">&larr; Kembali ke Manage tamu</a>
                        </div>
                    @endforelse
                        </tbody>
                    </table>
                </div>

                {{-- card footer --}}
                <div class="card-footer">
                    {{ $tamu->links() }}
                </div>

            </div>
        </div>
    </div>

    {{-- modal create --}}
    <x-modal-parent id="createModal" ariaLabelledby="ModalCreate" modalSize="">
        <x-modal-header titleHeader="Masukan data tamu" idHeader="ModalCreate" />
        <x-modal-body>
            <x-form action="{{ route('manage-tamu.store') }}" id="" method="POST" bajak="post">
                <div class="row">
                    <x-modal-input class="col-6" value="{{ old('email') }}" name='email' label="Email" type="email" />
                    <x-modal-input class="col-6" value="{{ old('no_hp') }}" name='no_hp' label="Nomor Hp" type="phone" />
                    <x-password-input class="col-12" />
                    <x-modal-input class="col-12" value="{{ old('password_confirmation') }}" name='password_confirmation' label="Konfirmasi password" type="password" />
                </div>
                <div class="modal-footer col-12">
                    <x-button type="button" class="btn btn-outline-danger" desc="Batal" dataDismiss="modal" />
                    <x-button type="submit" class="btn btn-primary" desc="Simpan" dataDismiss="" />
                </div>
            </x-form>
        </x-modal-body>
    </x-modal-parent>

    {{-- modal detail --}}
    <x-modal-parent id="detailModal" ariaLabelledby="ModalDetail" modalSize="">
        <x-modal-header idHeader="detailModal" titleHeader="Detail data Tamu" />
        <div class="modal-body">
        </div>
    </x-modal-parent>

@endsection

@push('page-script')
    <script>
        $(document).ready(function() {

            // error create modal
            @if ($errors->any())
                $('#createModal').modal('show');
            @endif

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
                        $(`#delete-tamu${id}`).submit();
                    }
                })
            });

            // detail action
            $('.btn-detail').on('click', function() {
                let id = $(this).data('id')
                $.ajax({
                    url: `/admin/manage-tamu/${id}`,
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
