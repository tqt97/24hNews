@extends('layouts.admin')

@push('title')
    {{ __('Add new user') }}
@endpush
@push('styles')
    @include('admin.partials.filepond-style')
@endpush
@section('content')
    <div class="content">
        <x-admin.header title="{{ __('Add new user') }}" page="{{ __('Add new user') }}" />
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary card-outline">
                        <x-form.form action="{{ route('admin.admins.store') }}" hasFile>
                            <div class="card-body">
                                <x-form.warning />
                                <div class="row">
                                    <div class="col-sm-6">
                                        <x-form.input label="{{ __('Name') }}" name="name" />
                                    </div>
                                    <div class="col-sm-6">
                                        <x-form.input label="{{ __('Email') }}" type="email" name="email" />
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <x-form.input label="{{ __('Address') }}" name="address" />
                                    </div>
                                    <div class="col-sm-6">
                                        <x-form.input label="{{ __('Phone') }}" name="phone" />
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <x-form.input label="{{ __('Password') }}" type="password" name="password" required />
                                    </div>
                                    <div class="col-sm-6">
                                        <x-form.input label="{{ __('Confirm Password') }}" type="password" name="password_confirm"
                                            required />
                                    </div>
                                </div>
                                <x-form.select label="{{ __('Role') }}" name="role_id[]" class="select2_role" multiple
                                    required>
                                    <option></option>
                                    @foreach ($roles as $role)
                                        <option value="{{ $role->id }}">{{ $role->name }}</option>
                                    @endforeach
                                </x-form.select>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <x-form.file label="{{ __('Image') }}" name="image" />
                                    </div>
                                </div>
                            </div>
                            <x-form.submit  submit="{{ __('Add new') }}" reset="{{ __('Refresh') }}"/>
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
                placeholder: "{{ __('Choose role') }}",
                allowClear: true
            });
        });
    </script>
@endpush
