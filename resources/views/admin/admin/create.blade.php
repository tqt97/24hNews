@extends('layouts.admin')

@push('title')
    {{ __('Thêm thông tin người dùng') }}
@endpush
@push('styles')
    @include('admin.partials.filepond-style')
@endpush
@section('content')
    <div class="content">
        @include('admin.partials.header',[$title = 'Thêm mới người dùng', $current_page = 'Thêm người dùng'])
        <div class="container-fluid">
            <div class="row">

                <div class="col-md-12">
                    <div class="card card-primary card-outline">

                        <form action="{{ route('admin.admins.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                @include('admin.components.warning-top')
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Tên người dùng <code>*</code> :</label>
                                            <input type="text" name="name"
                                                class="form-control @error('name') is-invalid @enderror"
                                                value="{{ old('name') }}" placeholder="Nhập tên người dùng" autofocus
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
                                                value="{{ old('email') }}" placeholder="Nhập email người dùng" required>
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
                                            <input type="text" name="address"
                                                class="form-control @error('address') is-invalid @enderror"
                                                value="{{ old('address') }}" placeholder="Nhập địa chỉ">
                                            @error('address')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Điện thoại :</label>
                                            <input type="text" name="phone"
                                                class="form-control @error('phone') is-invalid @enderror"
                                                value="{{ old('phone') }}" placeholder="Nhập số điện thoại">
                                            @error('phone')
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
                                            <label>Mật khẩu <code>*</code> :</label>
                                            <input type="password" name="password"
                                                class="form-control @error('password') is-invalid @enderror" required>
                                            @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Nhập lại mật khẩu <code>*</code> :</label>
                                            <input type="password" name="password_confirm"
                                                class="form-control @error('password_confirm') is-invalid @enderror"
                                                required>
                                            @error('password_confirm')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Chọn vai trò <code>*</code> :</label>
                                    <select name="role_id[]" class="form-control select2_role" multiple>
                                        <option></option>
                                        @foreach ($roles as $role)
                                            <option value="{{ $role->id }}">{{ $role->name }}</option>
                                        @endforeach

                                    </select>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Hình đại diện :</label>
                                            <input type="file" name="image" id="image" multiple data-max-files="1"
                                                data-max-files-message="Chỉ được chọn 1 file" accept="image/*" />
                                        </div>
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
    @include('admin.partials.filepond-script')

    <script>
        $(function() {
            $(".select2_role").select2({
                placeholder: "--- Chọn role ---",
                allowClear: true
            });
        });
    </script>
@endpush
