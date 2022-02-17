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

                        <x-form.form action="{{ route('admin.categories.update',$category->id) }}" hasFile  modMethod="PUT">
                            <div class="card-body">
                                <x-form.warning />
                                <div class="row">
                                    <div class="col-sm-6">
                                        <x-form.input label="Tên danh mục :" name="name" value="{{ $category->name }}"/>
                                    </div>
                                    <div class="col-sm-6">
                                        <x-form.select label="Chọn danh mục (Mặc định là danh mục gốc) :" name="parent_id"
                                            class="select2_category" required>
                                            <option value="0">|-- Danh mục gốc</option>
                                            {!! $htmlOption !!}
                                        </x-form.select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-2">
                                        <x-form.show-image label="Ảnh đại diện :"
                                            src="{{ $category->getFirstMediaUrl('categories', 'thumb') }}"
                                            alt="{{ $category->name }}" />
                                    </div>
                                    <div class="col-sm-10">
                                        <x-form.file label="Chọn ảnh mới :" name="image" />
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <x-form.checkbox label="Trạng thái :" name="status" display="Hiển thị"
                                            isChecked="{{ $category->status == 1 ? 'checked' : '' }}" />
                                    </div>
                                    <div class="col-sm-6">
                                        <x-form.checkbox label="Nổi bật :" name="is_highlight" display="Nổi bật"
                                            isChecked="{{ $category->is_highlight == 1 ? 'checked' : '' }}" />
                                    </div>
                                </div>
                            </div>
                            <x-form.submit submit="Cập nhật" reset="Làm mới" />
                        </x-form.form>
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
