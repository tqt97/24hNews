<div class="form-group">
    @if ($label ?? null)
        <label>
            {{ $label }} {{ $required ?? false ? '*' : '' }}
        </label>
    @endif

    <textarea class="form-control @error($name) is-invalid @enderror" id="{{ $name }}"
        name="{{ $name }}">{{ old($name, $value ?? '') }}</textarea>

    @error($name)
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
</div>
