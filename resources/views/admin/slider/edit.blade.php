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
                        <x-form.form action="{{ route('admin.sliders.update', $slider->id) }}" modMethod="PUT" hasFile>
                            <div class="card-body">
                                <x-form.warning />
                                <div class="row">
                                    <div class="col-sm-6">
                                        <x-form.input label="Tiêu đề :" name="title" value="{{ $slider->title }}"
                                            required />
                                    </div>
                                    <div class="col-sm-6">
                                    <x-form.input label="Link mục tiêu :" name="url" value="{{ $slider->url }}" />
                                    </div>

                                </div>
                                <x-form.textarea label="Mô tả ngắn :" name="description" value="{!! $slider->description !!}" />

                                <div class="row">
                                    <div class="col-sm-2">
                                        <x-form.show-image label="Hình đại diện :"
                                            src="{{ $slider->getFirstMediaUrl('sliders', 'thumb') }}"
                                            alt="{{ $slider->title }}" />
                                    </div>
                                    <div class="col-sm-10">
                                        <x-form.file label="Chọn ảnh mới :" name="image" />
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="col-sm-6">
                                                <x-form.input label="Sắp xếp :" name="order" value="{{ $slider->order }}" placeholder="Mặc định 0" />
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <x-form.checkbox label="Trạng thái :" name="status" display="Hiển thị"
                                            isChecked="{{ $slider->status == 1 ? 'checked' : '' }}" />
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
