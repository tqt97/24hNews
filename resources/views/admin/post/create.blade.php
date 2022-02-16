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
                        <form action="{{ route('admin.posts.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                @include('admin.components.warning-top')

                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Tên bài viết <code>*</code> :</label>
                                            <input type="text" name="title"
                                                class="form-control @error('title') is-invalid @enderror"
                                                value="{{ old('title') }}" placeholder="Điền tên bài viết" autofocus>
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
                                                style="width: 100%;" required>
                                                @foreach ($categories as $category)
                                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Hình đại diện: <code>*</code> :</label>
                                            <input type="file" name="image" id="image" multiple data-max-files="1"
                                                data-max-files-message="Chỉ được chọn 1 file" accept="image/*" />
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Mô tả ngắn <code>*</code> :</label>
                                    <textarea class="form-control @error('description') is-invalid @enderror"
                                        id="description" name="description">{{ old('description') }}</textarea>
                                    @error('description')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Chi tiết bài viết <code>*</code> :</label>
                                    <textarea class="form-control @error('content') is-invalid @enderror" id="content"
                                        name="content">{{ old('content') }}</textarea>
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
                                            <option value="{{ $tag->name }}">{{ $tag->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="row">
                                    <div class="col-sm-6">
                                        @include('admin.components.form.status-create')
                                    </div>
                                    <div class="col-sm-6">
                                        @include('admin.components.form.is-highlight-create')
                                    </div>
                                </div>
                            </div>
                            @include('admin.components.card-footer-create')
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
