<div class="form-group col-6">
    <label for="{{ $label }}">{{ $label }}</label>
    <div class="input-group mb-3">
        <div class="input-group-prepend">
            <span class="input-group-text">Rp</span>
        </div>
        <input type="text" id="{{ $name }}" name="{{ $name }}" value="{{ $value }}" placeholder="{{ $placeholder }}"
            class="form-control @error($name) is-invalid @enderror" aria-label="Amount (to the nearest dollar)">
        <div class="input-group-append">
            <span class="input-group-text">.00</span>
        </div>
    </div>
    @error($name)
        <small id="{{ $name }}" class="form-text text-danger">{{ $message }}</small>
    @enderror
</div>
