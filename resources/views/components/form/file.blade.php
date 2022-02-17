<div class="form-group">
    @if ($label ?? null)
        <label>
            {{ $label }} {{ $required ?? false ? '*' : '' }}
        </label>
    @endif
    <input type="file" name="{{ $name }}" id="{{ $name }}" accept="image/*"
        @if ($max ?? null) data-max-files="{{ $max ?? false ? $max : '' }}" @endif
        @if ($maxFileMessage ?? null) data-max-files-message="{{ $maxFileMessage ?? false ? $maxFileMessage : '' }}" @endif
        {{ $multiple ?? false ? 'multiple' : '' }} {{ $required ?? false ? 'required' : '' }} />
</div>
