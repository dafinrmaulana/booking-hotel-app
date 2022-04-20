<div class="row">
    <div class="form-group col-6">
        <label for="nama">Nama</label>
        <input type="text" name="nama" value="{{ $data->nama }}" class="form-control" readonly>
    </div>
    <div class="form-group col-6">
        <label for="username">Username</label>
        <input type="text" name="username" value="{{ $data->username }}" class="form-control" readonly>
    </div>
    <div class="form-group col-12">
        <label for="username">Role</label>
        <input type="text" name="username" value="{{ $data->role }}" class="form-control" readonly>
    </div>
    <div class="form-group col-6">
        <label for="nama">Ditambah</label>
        <input type="text" name="nama" value="{{ $data->created_at }}" class="form-control" readonly>
    </div>
    <div class="form-group col-6">
        <label for="username">Diubah</label>
        <input type="text" name="username" value="{{ $data->updated_at }}" class="form-control" readonly>
    </div>
</div>
<div class="modal-footer col-12">
    <a href="{{ route('manage-admin.edit', $data->id) }}" class="btn btn-success">Edit data ?</a>
    <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Oke</button>
</div>
