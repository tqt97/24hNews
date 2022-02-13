<div class="form-group">
    <label class="form-check-label mb-2 font-weight-bold">Nổi bật :</label>
    <div class="form-check">
        <input type="hidden" name="is_highlight" value="0">
        <input class="form-check-input" type="checkbox" name="is_highlight" value="1"
            {{ old('is_highlight') ? 'checked' : '' }}>
    </div>
</div>
