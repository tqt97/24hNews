@extends('layouts.admin')

@push('title')
    {{ __('Thêm bài viết') }}
@endpush
@push('styles')
    <link rel="stylesheet" href="{{ asset('admin/plugins/summernote/summernote-bs4.min.css') }}">
    @include('admin.partials.filepond-style')
@endpush
@section('content')
    <div class="content">
        @include('admin.partials.header',[$title = 'Thêm mới bài viết', $current_page = 'Thêm bài viết'])
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary card-outline">
                        <x-form.form action="{{ route('admin.posts.store') }}" hasFile>
                            <div class="card-body">
                                <x-form.warning />
                                <div class="row">
                                    <div class="col-sm-6">
                                        <x-form.input label="Tên bài viết :" name="title" placeholder="Điền tên bài viết"
                                            required />
                                    </div>
                                    <div class="col-sm-6">
                                        <x-form.select label="Chọn danh mục bài viết :" name="categories[]" multiple
                                            class="select2_category w-100" required>
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                            @endforeach
                                        </x-form.select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <x-form.file label="Hình đại diện :" name="image" required />
                                    </div>
                                </div>

                                <x-form.textarea label="Mô tả ngắn :" name="description" />
                                <x-form.textarea label="Chi tiết bài viết :" name="content" />
                                <x-form.select label="Tags :" name="tags[]" multiple
                                    class="select2_tag w-100" required>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </x-form.select>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <x-form.status label="Trạng thái :" name="status" display="Hiển thị" checked />
                                    </div>
                                    <div class="col-sm-6">
                                        <x-form.status label="Nổi bật :" name="is_highlight" display="Nổi bật" />
                                    </div>
                                </div>
                            </div>
                            <x-form.submit submit="Thêm mới" reset="Làm mới" />
                        </x-form.form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script src="{{ asset('admin/plugins/summernote/summernote-bs4.min.js') }}"></script>
    @include('admin.partials.filepond-script')
    <script>
        $(function() {
            $(".select2_tag").select2({
                tags: true,
                allowClear: true,
                tokenSeparators: [',', ' ']
            });
            $(".select2_category").select2({
                placeholder: "Chọn danh mục bài viết",
                tokenSeparators: [',', ' '],
                allowClear: true
            });
            $('#content').summernote({
                height: 150,
                codemirror: {
                    theme: 'monokai'
                }
            });
        });
    </script>
@endpush
