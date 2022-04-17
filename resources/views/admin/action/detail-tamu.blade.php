<div class="row">
    <div class="form-group col-6">
        <label for="nama">Nama</label>
        <input type="text" name="nama" value="{{ old('nama', $data->nama) }}" class="form-control @if($data->nama == null) border border-warning @endif" readonly>
        @if($data->nama == null)
        <small id="email" class="form-text text-warning"><i class="fas fa-exclamation-triangle"></i> Nama user masih belum di registrasi</small>
        @endif
    </div>
    <div class="form-group col-6">
        <label for="username">Username</label>
        <input type="text" name="username" value="{{ old('username', $data->username) }}" class="form-control @if($data->username == null) border border-warning @endif" readonly>
        @if($data->username == null)
        <small id="email" class="form-text text-warning"><i class="fas fa-exclamation-triangle"></i> Username masih belum di registrasi</small>
        @endif
    </div>
    <div class="form-group col-6">
        <label for="email">Email</label>
        <input type="email" name="email" value="{{ old('email', $data->email) }}" class="form-control" readonly>
    </div>
    <div class="form-group col-6">
        <label for="no_hp">Nomor Hp</label>
        <input type="text" name="no_hp" value="{{ old('no_hp', $data->no_hp) }}" class="form-control @if($data->no_hp == null) border border-warning @endif" readonly>
        @if($data->no_hp == null)
        <small id="no_hp" class="form-text text-warning"><i class="fas fa-exclamation-triangle"></i> Nomor Hp masih belum di registrasi</small>
        @endif
    </div>
    <div class="form-group col-6">
        <label for="created_at">Di buat</label>
        <input type="text" name="created_at" value="{{ old('created_at', $data->created_at) }}" class="form-control" readonly>
    </div>
    <div class="form-group col-6">
        <label for="updated_at">Di ubah</label>
        <input type="text" name="updated_at" value="{{ old('updated_at', $data->updated_at) }}" class="form-control" readonly>
    </div>
</div>
<div class="modal-footer col-12">
    <a href="{{ route('manage-tamu.edit', $data->id) }}" class="btn btn-success">Edit data ?</a>
    <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Oke</button>
</div>
