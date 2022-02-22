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
                        <x-form.form action="{{ route('admin.admins.store') }}" hasFile>
                            <div class="card-body">
                                <x-form.warning />
                                <div class="row">
                                    <div class="col-sm-6">
                                        <x-form.input label="Tên người dùng :" name="name" />
                                    </div>
                                    <div class="col-sm-6">
                                        <x-form.input label="Email :" type="email" name="email" />
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <x-form.input label="Địa chỉ :" name="address" />
                                    </div>
                                    <div class="col-sm-6">
                                        <x-form.input label="Điện thoại :" name="phone" />
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <x-form.input label="Mật khẩu :" type="password" name="password" required />
                                    </div>
                                    <div class="col-sm-6">
                                        <x-form.input label="Nhập lại mật khẩu :" type="password" name="password_confirm"
                                            required />
                                    </div>
                                </div>
                                <x-form.select label="Chọn vai trò :" name="role_id[]" class="select2_role" multiple
                                    required>
                                    <option></option>
                                    @foreach ($roles as $role)
                                        <option value="{{ $role->id }}">{{ $role->name }}</option>
                                    @endforeach
                                </x-form.select>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <x-form.file label="Hình đại diện :" name="image" />
                                    </div>
                                </div>
                            </div>
                            <x-form.submit submit="Thêm mới" reset="Làm mới" />
                        </x-form.form>
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
