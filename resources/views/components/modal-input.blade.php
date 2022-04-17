<div class="form-group {{ $class }}">
    <label for="{{ $name }}">{{ $label }}</label>
    <input type="{{ $type }}"
    name="{{ $name }}"
    value="{{ $value }}"
    class="form-control
    @error($name) is-invalid @enderror"
    id="{{ $name }}"
    aria-describedby="{{ $name }}"
    placeholder="Masukan {{ $label }}" required>
    @error($name)
        <small id="{{ $name }}" class="form-text text-danger">{{ $message }}</small>
    @enderror
</div>
