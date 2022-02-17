<div class="form-group">
    @if ($label ?? null)
        <label>
            {{ $label }} {{ $required ?? false ? '*' : '' }}
        </label>
    @endif
    <select type="{{ $type ?? 'text' }}" name="{{ $name }}" id="{{ $name }}"
        class="form-control @error($name) is-invalid @enderror {{ $class ?? '' }}"
        @if ($placeholder ?? null) placeholder="{{ $placeholder ?? '' }}" @endif
        @if ($multiple ?? null) multiple="{{ $multiple ?? '' }}" @endif
        @if ($value ?? null) value="{{ old($name, $value ?? '') }}" @endif
        {{ $required ?? false ? 'required' : '' }}>

        {{ $slot }}

        @error($name)
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </select>
</div>
