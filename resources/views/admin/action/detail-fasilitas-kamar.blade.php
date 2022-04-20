<div class="row">
    <div class="form-group col-12">
        <label for="nama">Nama</label>
        <input type="text" name="nama" value="{{ $data->nama_fasilitas }}" class="form-control" readonly>
    </div>
    <div class="form-group col-12">
        <label for="keterangan">Keterangan</label>
        <textarea class="form-control" name="keterangan"
            id="keterangan" rows="5" readonly>{{  $data->keterangan }}</textarea>
    </div>
    <div class="form-group col-6">
        <label for="nama">Ditambahkan pada</label>
        <input type="text" name="nama" value="{{ old('nama', $data->created_at) }}"
            class="form-control @error('nama') is-invalid @enderror" id="nama" aria-describedby="nama"
            placeholder="Masukan nama" readonly>
    </div>
    <div class="form-group col-6">
        <label for="nama">Diubah pada</label>
        <input type="text" name="nama" value="{{ old('nama', $data->updated_at) }}"
            class="form-control @error('nama') is-invalid @enderror" id="nama" aria-describedby="nama"
            placeholder="Masukan nama" readonly>
    </div>
<div class="modal-footer col-12">
    <a href="{{ route('manage-fasilitas-kamar.edit', $data->id) }}" class="btn btn-success">Edit data ?</a>
    <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Oke</button>
</div>
