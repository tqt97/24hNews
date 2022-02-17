<div class="form-group">
    @if ($label ?? null)
        <label>
            {{ $label }}
        </label>
    @endif
    <img src="{{ $src ?? '' }}" alt="{{ $alt ?? '' }}" style="display: block;border-radius: 5px" width="120px">
</div>
