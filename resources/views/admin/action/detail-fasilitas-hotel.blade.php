<div class="row">
    @if ($data->foto)
        <div class="form-group col-6">
            <img src="{{ asset('img/fasilitasHotel/' . $data->foto) }}" alt="foto fasilitas hotel" data-fancybox data-src
                style="width:100%">
        </div>
    @endif
    @if ($data->foto === null)
        <div class="form-group col-6">
            <img style="cursor: pointer" data-fancybox data-src
                src="https://upload.wikimedia.org/wikipedia/commons/d/d1/Image_not_available.png" alt="foto fasilitas hotel"
                width="100%">
        </div>
    @endif
    <div class="form-group col-6">

        <div class="row">
            <div class="col-4 mt-2">
                Nama Fasilitas
            </div>
            <div class="col-8 mt-2">
                : {{ $data->nama_fasilitas_hotel }}
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
    <a href="{{ route('manage-fasilitas-hotel.edit', $data->id) }}" class="btn btn-success">Edit data ?</a>
    <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Oke</button>
</div>
