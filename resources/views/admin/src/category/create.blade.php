@extends('admin.layouts.base')

@section('title', 'Thêm danh mục')
@section('styles')
    <link href="{{ asset('admin/dist/css/handleUploadImageSingle.css') }}" rel="stylesheet">
@endsection
@section('content')
    <div class="content">
        @include('admin.layouts.partials.header',[$title = 'Thêm mới danh mục', $current_page = 'Thêm danh mục'])
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary-outline">
                        <form action="{{ route('admin.category.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tên danh mục :</label>
                                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                                        placeholder="Điền tên danh mục" autofocus required>
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                {{-- <p class="btn btn-primary mb-3" id="showUploadImageDiv">
                                    <i class="fa fa-image"></i>
                                    Thêm hình ảnh
                                </p> --}}
                                <div class="form-group">
                                    <label>Hình ảnh :</label>
                                    <div class="input-group" id="divMainUpload">
                                        <div class="custom-file">
                                            {{-- <input type="file" class="custom-file-input" name="image" accept="image/*"
                                                onchange="readURL(this);"> --}}
                                            <input class="custom-file-input2" type="file" id="image" name="image" />
                                            {{-- <label class="custom-file-label"></label> --}}
                                        </div>
                                    </div>
                                    <div class="my-3">
                                        <img id="blah" src="" width="150px" height="auto" />
                                    </div>
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
                                            <label class="form-check-label mb-2 font-weight-bold">Is new :</label>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="is_new">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary mr-3">
                                    <i class="fa fa-save"></i>
                                    Tạo mới</button>
                                <button type="reset" class="btn btn-secondary">
                                    <i class="fa fa-remove"></i>
                                    Làm mới
                                </button>
                            </div>
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
