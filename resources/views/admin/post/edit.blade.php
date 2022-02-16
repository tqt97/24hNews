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
                        <form action="{{ route('admin.posts.update', $post->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="card-body">
                                @include('admin.components.warning-top')
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Tên bài viết <code>*</code> :</label>
                                            <input type="text" name="title"
                                                class="form-control @error('title') is-invalid @enderror"
                                                value="{{ $post->title }}" placeholder="Điền tên bài viết" autofocus
                                                required>
                                            @error('title')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Chọn danh mục bài viết <code>*</code> :</label>
                                            <select class="select2_category" multiple="multiple" name="categories[]"
                                                style="width: 100%;">
                                                @foreach ($categories as $category)
                                                    <option value="{{ $category->id }}"
                                                        {{ $categoryOfPost->contains('id', $category->id) ? 'selected' : '' }}>
                                                        {{ $category->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-2">
                                        <div class="form-group">
                                            <label>Hình đại diện:</label>
                                            <img src="{{ $post->getFirstMediaUrl('posts', 'thumb') }}"
                                                alt="{{ $post->title }}" style="display: block;border-radius: 5px"
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
                                <div class="form-group">
                                    <label>Mô tả ngắn <code>*</code> :</label>
                                    <textarea class="form-control" id="description"
                                        name="description">{!! $post->description !!}</textarea>
                                </div>
                                <div class="form-group">
                                    <label>Chi tiết bài viết <code>*</code> :</label>
                                    <textarea class="form-control @error('content') is-invalid @enderror" id="content"
                                        name="content">{!! $post->content !!}</textarea>
                                    @error('content')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Tags :</label>
                                    <select class="select2_tag" multiple="multiple" name="tags[]"
                                        data-placeholder="Thêm tag cho bài viết" style="width: 100%;">
                                        @foreach ($tags as $tag)
                                            <option value="{{ $tag->name }}"
                                                {{ $tagOfPost->contains('id', $tag->id) ? 'selected' : '' }}>
                                                {{ $tag->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="form-check-label mb-2 font-weight-bold">Trạng thái :</label>
                                            <div class="form-check">
                                                <input type="hidden" name="status" value="0">
                                                <input class="form-check-input" type="checkbox" name="status" value="1"
                                                    {{ old('status') || $post->status ? 'checked' : '' }}>
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
                                                    {{ old('is_highlight') || $post->is_highlight ? 'checked' : '' }}>
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
