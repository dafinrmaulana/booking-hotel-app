<div class="row">
    @if ($data->foto)
        <div class="form-group col-6">
            <img src="{{ asset('img/kamar/' . $data->foto) }}" alt="foto kamar" data-fancybox data-src
                style="width:100%">
        </div>
    @endif
    @if ($data->foto === null)
        <div class="form-group col-6">
            <img style="cursor: pointer" data-fancybox data-src
                src="https://upload.wikimedia.org/wikipedia/commons/d/d1/Image_not_available.png" alt="foto kamar"
                width="100%">
        </div>
    @endif
    <div class="form-group col-6">

        <div class="row">
            <div class="col-4 mt-2">
                Nama Kamar
            </div>
            <div class="col-8 mt-2">
                : {{ $data->nama_kamar }}
            </div>
            <div class="col-4 mt-2">
                Harga
            </div>
            <div class="col-8 mt-2">
                : Rp. {{ number_format($data->harga, 2, ',', '.') }}
            </div>
            <div class="col-4 mt-2">
                Jumlah
            </div>
            <div class="col-8 mt-2">
                : {{ $data->jumlah }} kamar
            </div>
            <div class="col-4 mt-2">
                Fasilitas
            </div>

            <div class="col-8 mt-2">
                :
                @foreach ($data->fasilitas as $fasi)
                @php
                    $fasil = $faska->where('id', $fasi->id)->first();
                @endphp
                {{ $fasil->nama_fasilitas.',', '.' }}
                @endforeach
            </div>
            <div class="col-4 mt-2">
                Keterangan
            </div>
            <div class="col-8 mt-2">
                : {{ $data->keterangan }}
            </div>
        </div>
    </div>
</div>
<div class="modal-footer col-12">
    <a href="{{ route('manage-kamar.edit', $data->id) }}" class="btn btn-success">Edit data ?</a>
    <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Oke</button>
</div>
