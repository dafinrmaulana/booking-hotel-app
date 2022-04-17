<div class="form-group {{ $class }}">
    <label for="password">Password</label>
    <div class="input-group mb-3">
        <input type="password" name="password"
            class="form-control @error('password') is-invalid @enderror" id="password"
            placeholder="Masukan password" aria-describedby="basic-addon2" required>
        <div class="input-group-append show-trigger">
            <span class="input-group-text" id="basic-addon2">
                <i class="fas fa-eye d-none" id="hide_eye"></i>
                <i class="fas fa-eye-slash" id="show_eye"></i>
            </span>
        </div>
    </div>
    @error('password')
        <small id="password" class="form-text text-danger">{{ $message }}</small>
    @enderror
</div>
