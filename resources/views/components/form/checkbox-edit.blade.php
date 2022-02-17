<div class="form-group">
    @if ($label ?? null)
        <label>
            {{ $label }} {{ $required ?? false ? '*' : '' }}
        </label>
    @endif
    <div class="form-check">
        <input type="hidden" name="{{ $name }}" value="0">
        {{ $slot }}
        <label class="form-check-label">{{ $display }}</label>
    </div>
</div>
