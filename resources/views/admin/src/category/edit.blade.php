@extends('admin.layouts.base')

@section('title', 'Sửa danh mục')
@section('styles')
    <link href="{{ asset('admin/dist/css/handleUploadImageSingle.css') }}" rel="stylesheet">
@endsection
@section('content')
    <div class="content">
        @include('admin.layouts.partials.header',[$title = 'Sửa danh mục', $current_page = 'Sửa danh mục'])
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary-outline">
                        <form action="{{ route('admin.category.update',$category->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tên danh mục :</label>
                                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                                       value="{{ $category->name }}" autofocus required>
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Hình ảnh :</label>
                                    <div class="input-group" id="divMainUpload">
                                        <div class="custom-file">
                                            <input class="custom-file-input2" type="file" id="image" name="image" />
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="form-check-label mb-2 font-weight-bold">Trạng thái :</label>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="status" @if ($category->status == 1) checked @endif>
                                                <label class="form-check-label">Hiện</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="form-check-label mb-2 font-weight-bold">Nổi bật :</label>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="is_highlight" @if ($category->is_highlight == 1) checked @endif>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @include('admin.src.components.card-footer-edit')
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="{{ asset('admin/dist/js/handleUploadImageSingle.js') }}"></script>
@endsection
