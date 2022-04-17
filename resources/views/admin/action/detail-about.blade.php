<div class="row">
    <div class="col-6">
        <div class="form-group col-12">
            <label for="about">about</label>
            <textarea
            rows="12"
            class="form-control"
            @error('about') style="border: 1px solid red" @enderror
            name="about"
            id="about" rows="3" readonly>{{ old('data', $data->about) }}
            </textarea>
        </div>
    </div>
    <div class="col-6">
        @if ($data->foto)
            <div class="form-group col-12">
                <label for="about">Foto</label>
                <img src="{{ asset('img/about/' . $data->foto) }}" alt="foto about" data-fancybox data-src
                    style="width:100%">
            </div>
        @endif
        @if ($data->foto === null)
            <div class="form-group col-12">
                <label for="about">Foto</label>
                <img style="cursor: pointer" data-fancybox data-src
                    src="https://upload.wikimedia.org/wikipedia/commons/d/d1/Image_not_available.png" alt="foto about"
                    width="100%">
            </div>
        @endif
    </div>
</div>
<div class="modal-footer col-12">
    <a href="{{ route('manage-about.edit', $data->id) }}" class="btn btn-success">Edit data ?</a>
    <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Oke</button>
</div>
