@extends('admin.layouts.base')

@section('title', 'Thêm bài viết')
@section('styles')
    <link href="{{ asset('admin/dist/css/handleUploadImageSingle.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('admin/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/plugins/summernote/summernote-bs4.min.css') }}">
@endsection
@section('content')
    <div class="content">
        @include('admin.layouts.partials.header',[$title = 'Thêm mới bài viết', $current_page = 'Thêm bài viết'])
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary card-outline">
                        <form action="{{ route('admin.post.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                @include('admin.src.components.warning-top')

                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Tên bài viết <code>*</code> :</label>
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
                                <div class="form-group">
                                    <label>Hình ảnh <code>*</code> :</label>
                                    <div class="input-group" id="divMainUpload">
                                        <div class="custom-file">
                                            <input class="form-control @error('image') is-invalid @enderror" type="file"
                                                id="image" name="image" accept="image/*" />
                                        </div>
                                        @error('image')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                </div>
                                <div class="form-group">
                                    <label>Mô tả ngắn <code>*</code> :</label>
                                    <textarea class="form-control @error('description') is-invalid @enderror"
                                        id="description" name="description">{!! old('description') !!}</textarea>
                                    @error('description')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Chi tiết bài viết <code>*</code> :</label>
                                    <textarea class="form-control @error('content') is-invalid @enderror" id="content"
                                        name="content">{!! old('content') !!}</textarea>
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
                                        @include('admin.src.components.form.status-create')
                                    </div>
                                    <div class="col-sm-6">
                                        @include('admin.src.components.form.is-highlight-create')
                                    </div>
                                </div>
                            </div>
                            @include('admin.src.components.card-footer-create')
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="{{ asset('admin/dist/js/handleUploadImageSingle.js') }}"></script>
    <script src="{{ asset('admin/plugins/select2/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('admin/plugins/summernote/summernote-bs4.min.js') }}"></script>

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
            $('#description').summernote({
                height: 80,
                codemirror: {
                    theme: 'monokai'
                }
            });
            $('#content').summernote({
                height: 150,
                codemirror: {
                    theme: 'monokai'
                }
            });
        });
    </script>

@endsection
