<div class="form-group">
    <label class="form-check-label mb-2 font-weight-bold">Trạng thái :</label>
    <div class="form-check">
        <input type="hidden" name="status" value="0">
        <input class="form-check-input" type="checkbox" name="status" value="1" {{ old('status') ? 'checked' : '' }}
            checked>
        <label class="form-check-label">Hiện</label>
    </div>
</div>
