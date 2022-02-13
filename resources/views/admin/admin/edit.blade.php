@extends('layouts.admin')

@section('title', 'Cập nhật thông tin Admin')
@section('styles')
    <link rel="stylesheet" href="{{ asset('admin/plugins/select2/css/select2.min.css') }}">
    <link href="{{ asset('admin/dist/css/handleUploadImageSingle.css') }}" rel="stylesheet">
@endsection
@section('content')
    <div class="content">
        @include('admin.partials.header',[$title = 'Cập nhật thông tin Admin', $current_page = 'Cập nhật'])
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary card-outline">
                        <form action="{{ route('admin.admins.update', $admin->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="card-body">
                                @include('admin.components.warning-top')

                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Tên người dùng <code>*</code> :</label>
                                            <input type="text" name="name"
                                                class="form-control @error('name') is-invalid @enderror"
                                                value="{{ $admin->name }}" placeholder="Điền tên người dùng" autofocus
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
                                            <label>Email <code>*</code> :</label>
                                            <input type="email" name="email"
                                                class="form-control @error('email') is-invalid @enderror"
                                                value="{{ $admin->email }}" placeholder="Điền email người dùng" required>
                                            @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Địa chỉ :</label>
                                            <input type="pass" name="address" class="form-control"
                                                value="{{ $admin->address }}">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Điện thoại :</label>
                                            <input type="text" name="phone" class="form-control"
                                                value="{{ $admin->phone }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Mật khẩu :</label>
                                            <input type="password" name="password"
                                                class="form-control @error('password') is-invalid @enderror">
                                            @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Nhập lại mật khẩu :</label>
                                            <input type="password" name="password_confirm"
                                                class="form-control @error('password_confirm') is-invalid @enderror">
                                            @error('password_confirm')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Chọn vai trò :</label>
                                    <select name="role_id[]" class="form-control select2_role" multiple>
                                        <option></option>
                                        @foreach ($roles as $role)
                                            <option value="{{ $role->id }}"
                                                {{ $roleOfAdmin->contains('id', $role->id) ? 'selected' : '' }}>
                                                {{ $role->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="row">
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label>Ảnh đại diện:</label>
                                            <div class="input-group">
                                                <div class="custom-file">
                                                </div>
                                            </div>
                                            <div class="my-3">
                                                <img src="{{ $admin->imageUrl() }}"
                                                    class="imageThumb" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-8">
                                        <div class="form-group">
                                            <label>Chọn ảnh mới:</label>
                                            <div class="input-group" id="divMainUpload">
                                                <div class="custom-file">
                                                    <input class="file-input" type="file" id="image" name="image" />
                                                </div>
                                            </div>
                                            <div class="my-3">

                                                <img id="blah" src="" width="150px" height="auto" />

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
@section('scripts')
    <script src="{{ asset('admin/plugins/select2/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('admin/dist/js/handleUploadImageSingle.js') }}"></script>

    <script>
        $(function() {
            $(".select2_role").select2({
                placeholder: "--- Chọn role ---",
                allowClear: true
            });
        });
    </script>
@endsection
