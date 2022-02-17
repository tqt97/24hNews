<div class="form-group">
    @if ($label ?? null)
        <label>
            {{ $label }} {{ $required ?? false ? '*' : '' }}
        </label>
    @endif
    <div class="form-check">
        <input type="hidden" name="{{ $name }}" value="0">
        <input class="form-check-input" type="checkbox" name="{{ $name }}" id="{{ $name }}"
        value="1"
        {{ old($name) ? 'checked' : '' }}
        {{ $checked ?? null ? 'checked' : '' }}>
        <label class="form-check-label">{{ $display }}</label>
    </div>
</div>
