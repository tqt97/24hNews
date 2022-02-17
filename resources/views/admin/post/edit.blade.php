@extends('layouts.admin')

@push('title')
    {{ __('Sửa bài viết') }}
@endpush
@push('styles')
    <link rel="stylesheet" href="{{ asset('admin/plugins/summernote/summernote-bs4.min.css') }}">
    @include('admin.partials.filepond-style')
@endpush
@section('content')
    <div class="content">
        @include('admin.partials.header',[$title = 'Sửa mới bài viết', $current_page = 'Sửa bài viết'])
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary card-outline">
                        <x-form.form action="{{ route('admin.posts.update', $post->id) }}" hasFile modMethod="PUT">
                            <div class="card-body">
                                <x-form.warning />
                                <div class="row">
                                    <div class="col-sm-6">
                                        <x-form.input label="Tên bài viết :" name="title" value="{{ $post->title }}" />
                                    </div>
                                    <div class="col-sm-6">
                                        <x-form.select label="Chọn danh mục bài viết :" name="categories[]"
                                            class="select2_category w-100" required multiple>
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}"
                                                    {{ $categoryOfPost->contains('id', $category->id) ? 'selected' : '' }}>
                                                    {{ $category->name }}
                                                </option>
                                            @endforeach
                                        </x-form.select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-2">
                                        <x-form.show-image label="Hình đại diện :"
                                            src="{{ $post->getFirstMediaUrl('posts', 'thumb') }}"
                                            alt="{{ $post->title }}" />
                                    </div>
                                    <div class="col-sm-10">
                                        <x-form.file label="Chọn ảnh mới :" name="image" />
                                    </div>
                                </div>
                                <x-form.textarea label="Mô tả ngắn :" name="description" value="{!! $post->description !!}" />
                                <x-form.textarea label="Chi tiết bài viết :" name="content"
                                    value="{!! $post->content !!}" />
                                <x-form.select label="Tags :" name="tags[]" multiple class="select2_tag w-100" required>
                                    @foreach ($tags as $tag)
                                        <option value="{{ $tag->name }}"
                                            {{ $tagOfPost->contains('id', $tag->id) ? 'selected' : '' }}>
                                            {{ $tag->name }}
                                        </option>
                                    @endforeach
                                </x-form.select>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <x-form.checkbox label="Trạng thái :" name="status" display="Hiển thị"
                                            isChecked="{{ $post->status == 1 ? 'checked' : '' }}" />
                                    </div>
                                    <div class="col-sm-6">
                                        <x-form.checkbox label="Nổi bật :" name="is_highlight" display="Nổi bật"
                                            isChecked="{{ $post->is_highlight == 1 ? 'checked' : '' }}" />
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
    <script src="{{ asset('admin/plugins/summernote/summernote-bs4.min.js') }}"></script>
    @include('admin.partials.filepond-script')

    <script>
        $(function() {
            $(".select2_tag").select2({
                tags: true,
                tokenSeparators: [',', ' ']
            });
            $(".select2_category").select2({
                placeholder: "--- Chọn danh mục bài viết ---",
                allowClear: true
            });
            // $('#description').summernote({
            //     height: 80,
            //     codemirror: {
            //         theme: 'monokai'
            //     }
            // });
            $('#content').summernote({
                height: 150,
                codemirror: {
                    theme: 'monokai'
                }
            });
        });
    </script>
@endpush
