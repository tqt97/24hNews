@extends('layouts.admin')

@section('title', 'Sửa tag')
@section('styles')
    <link href="{{ asset('admin/dist/css/handleUploadImageSingle.css') }}" rel="stylesheet">
@endsection
@section('content')
    <div class="content">
        @include('admin.partials.header',[$title = 'Sửa tag', $current_page = 'Sửa tag'])
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary card-outline">
                        <form action="{{ route('admin.tags.update',$tag->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="card-body">
                                @include('admin.components.warning-top')

                                <div class="form-group">
                                    <label>Tên tag <code>*</code> :</label>
                                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                                       value="{{ $tag->name }}" autofocus required>
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
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
@section('scripts')
    <script src="{{ asset('admin/dist/js/handleUploadImageSingle.js') }}"></script>
@endsection
