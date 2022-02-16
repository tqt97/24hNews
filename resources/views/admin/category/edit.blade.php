@extends('layouts.admin')

@push('title')
    {{ __('Sửa danh mục') }}
@endpush
@push('styles')
    @include('admin.partials.filepond-style')
@endpush
@section('content')
    <div class="content">
        @include('admin.partials.header',[$title = 'Sửa danh mục', $current_page = 'Sửa danh mục'])
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary card-outline">
                        <form action="{{ route('admin.categories.update', $category->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="card-body">
                                @include('admin.components.warning-top')
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Tên danh mục <code>*</code> :</label>
                                            <input type="text" name="name"
                                                class="form-control @error('name') is-invalid @enderror"
                                                value="{{ $category->name }}" autofocus required>
                                            @error('name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Chọn danh mục (Mặc định là danh mục gốc) <code>*</code> :</label>
                                            <select class="form-control select2_category" name="parent_id">
                                                <option value="0">|-- Danh mục gốc</option>
                                                {!! $htmlOption !!}
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-2">
                                        <div class="form-group">
                                            <label>Ảnh đại diện:</label>
                                            <img src="{{ $category->getFirstMediaUrl('categories', 'thumb') }}"
                                                alt="{{ $category->name }}" style="display: block;border-radius: 5px"
                                                width="120px">
                                        </div>
                                    </div>
                                    <div class="col-sm-10">
                                        <div class="form-group">
                                            <label>Chọn ảnh mới :</label>
                                            <input type="file" name="image" id="image" multiple data-max-files="1"
                                                data-max-files-message="Chỉ được chọn 1 file" accept="image/*" />
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="form-check-label mb-2 font-weight-bold">Trạng thái :</label>
                                            <div class="form-check">
                                                <input type="hidden" name="status" value="0">
                                                <input class="form-check-input" type="checkbox" name="status" value="1"
                                                    {{ old('status') || $category->status ? 'checked' : '' }}>
                                                <label class="form-check-label">Hiện</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="form-check-label mb-2 font-weight-bold">Nổi bật :</label>
                                            <div class="form-check">
                                                <input type="hidden" name="is_highlight" value="0">
                                                <input class="form-check-input" type="checkbox" name="is_highlight"
                                                    value="1"
                                                    {{ old('is_highlight') || $category->is_highlight ? 'checked' : '' }}>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @include('admin.components.card-footer-edit')
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    @include('admin.partials.filepond-script')

    <script>
        $(function() {
            $(".select2_category").select2({
                placeholder: "--- Chọn danh mục ---",
                allowClear: true
            });
        });
    </script>
@endpush
