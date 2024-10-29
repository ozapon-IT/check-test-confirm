<div class="form__group">
    <label class="form__label" for="{{ $id ?? $name }}">{{ $label }}</label>
    {{ $slot }}
    @error($name)
        <div class="form__error">{{ $message }}</div>
    @enderror
</div>