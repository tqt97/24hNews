@extends('layouts.admin')

@section('title', 'Thêm danh mục')
@section('styles')
    <link href="{{ asset('admin/dist/css/handleUploadImageSingle.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('admin/plugins/select2/css/select2.min.css') }}">
@endsection
@section('content')
    <div class="content">
        @include('admin.partials.header',[$title = 'Thêm mới danh mục', $current_page = 'Thêm danh mục'])
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary card-outline">
                        <form action="{{ route('admin.categories.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                @include('admin.components.warning-top')
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label">Tên danh mục <code>*</code> :</label>
                                                <input type="text" name="name"
                                                    class="form-control @error('name') is-invalid @enderror"
                                                    value="{{ old('name') }}" placeholder="Điền tên danh mục" autofocus
                                                    required>
                                                @error('name')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror

                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Chọn danh mục (Mặc định là danh mục gốc) <code>*</code> :</label>
                                            <select class="form-control select2_category" name="parent_id">
                                                <option value="0">|-- Danh mục gốc</option>
                                                {!! $htmlOption !!}
                                            </select>
                                        </div>
                                    </div>
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
@section('scripts')
    <script src="{{ asset('admin/dist/js/handleUploadImageSingle.js') }}"></script>
    <script src="{{ asset('admin/plugins/select2/js/select2.full.min.js') }}"></script>
    <script>
        $(function() {
            $(".select2_category").select2({
                placeholder: "--- Chọn danh mục ---",
                allowClear: true
            });
        });
    </script>
@endsection
