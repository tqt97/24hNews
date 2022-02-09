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
                    <div class="card card-primary-outline">
                        <form action="{{ route('admin.post.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Tên bài viết :</label>
                                            <input type="text" name="title"
                                                class="form-control @error('title') is-invalid @enderror"
                                                value="{{ old('title') }}" placeholder="Điền tên bài viết" autofocus
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
                                            <label>Chọn danh mục :</label>
                                            <select
                                                class="form-control select2_category @error('category_id') is-invalid @enderror"
                                                name="category_id">
                                                <option></option>
                                                @foreach ($categories as $category)
                                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('category_id')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Hình ảnh :</label>
                                    <div class="input-group" id="divMainUpload">
                                        <div class="custom-file">
                                            <input class="form-control @error('image') is-invalid @enderror" type="file"
                                                id="image" name="image" placeholder="Chọn hình ảnh" />
                                        </div>
                                        @error('image')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                </div>
                                <div class="form-group">
                                    <label>Mô tả ngắn :</label>
                                    <textarea class="form-control" id="description"
                                        name="description">{!! old('description') !!}</textarea>
                                </div>
                                <div class="form-group">
                                    <label>Chi tiết bài viết :</label>
                                    <textarea class="form-control @error('content') is-invalid @enderror" id="content"
                                        name="content">{!! old('content') !!}</textarea>
                                    @error('content')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Tags</label>
                                    <select class="select2_tag" multiple="multiple" name="tags[]"
                                        data-placeholder="Thêm tag cho bài viết" style="width: 100%;">
                                        @foreach ($tags as $tag)
                                            <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="form-check-label mb-2 font-weight-bold">Trạng thái :</label>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="status" checked>
                                                <label class="form-check-label">Hiện</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="form-check-label mb-2 font-weight-bold">Nổi bật :</label>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="is_highlight">
                                            </div>
                                        </div>
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
                tokenSeparators: [',', ' ']
            });
            $(".select2_category").select2({
                placeholder: "--- Chọn danh mục bài viết ---",
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
