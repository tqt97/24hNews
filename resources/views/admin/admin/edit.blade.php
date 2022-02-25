@extends('layouts.admin')

@push('title')
    {{ __('Update user') }}
@endpush
@push('styles')
    @include('admin.partials.filepond-style')
@endpush
@section('content')
    <div class="content">
        <x-admin.header title="{{ __('Update user') }}" page="{{ __('Update') }}" />
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary card-outline">
                        <x-form.form action="{{ route('admin.admins.update', $admin->id) }}" hasFile modMethod="PUT">
                            <div class="card-body">
                                <x-form.warning/>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <x-form.input label="{{ __('Name') }}" name="name" value="{{ $admin->name }}" />
                                    </div>
                                    <div class="col-sm-6">
                                        <x-form.input label="{{ __('Email') }}" type="email" name="email"
                                            value="{{ $admin->email }}" />
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <x-form.input label="{{ __('Address') }}" name="address" value="{{ $admin->address }}" />
                                    </div>
                                    <div class="col-sm-6">
                                        <x-form.input label="{{ __('Phone') }}" name="phone" value="{{ $admin->phone }}" />
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <x-form.input label="{{ __('Password') }}" type="password" name="password" />

                                    </div>
                                    <div class="col-sm-6">
                                        <x-form.input label="{{ __('Confirm Password') }}" type="password" name="password_confirm" />
                                    </div>
                                </div>
                                <x-form.select label="{{ __('Role') }}" name="role_id[]" class="select2_role" multiple
                                    required>
                                    @foreach ($roles as $role)
                                        <option value="{{ $role->id }}"
                                            {{ $roleOfAdmin->contains('id', $role->id) ? 'selected' : '' }}>
                                            {{ $role->name }}
                                        </option>
                                    @endforeach
                                </x-form.select>
                                <div class="row">
                                    <div class="col-sm-2">
                                        <x-form.show-image label="{{ __('Image') }}"
                                            src="{{ $admin->admin_image }}"
                                            alt="{{ $admin->name }}" />
                                    </div>
                                    <div class="col-sm-10">
                                        <x-form.file label="{{ __('Choose new image') }}" name="image" />
                                    </div>
                                </div>
                            </div>
                            <x-form.submit submit="{{ __('Update') }}" reset="{{ __('Refresh') }}" />
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
