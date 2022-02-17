<div class="form-group">
    @if ($label ?? null)
        <label>
            {{ $label }} {{ $required ?? false ? '*' : '' }}
        </label>
    @endif

    <input type="{{ $type ?? 'text' }}" name="{{ $name }}" id="{{ $name }}"
        class="form-control {{ $class ?? null }}@error($name) is-invalid @enderror"
        @if ($placeholder ?? null) placeholder="{{ $placeholder ?? '' }}" @endif
        @if ($value ?? null) value="{{ old($name, $value ?? '') }}" @endif
        {{ $required ?? false ? 'required' : '' }} autocomplete="off">

    @error($name)
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
</div>
