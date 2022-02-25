@extends('layouts.admin')

@push('title')
    {{ __('Edit user') }}
@endpush
@push('styles')
    @include('admin.partials.filepond-style')
@endpush
@section('content')
    <div class="content">
        <x-admin.header title="{{ __('Edit user') }}" page="{{ __('Edit user') }}" />
        <div class="container-fluid">
            <x-form.warning />
            <div class="row">
                <div class="col-md-6">
                    <div class="card card-primary card-outline">
                        <x-form.form action="{{ route('admin.profiles.update.information', $admin->id) }}" hasFile
                            modMethod="PUT">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <x-form.input label="{{ __('Name') }}" name="name"
                                            value="{{ $admin->name }}" />
                                    </div>
                                    <div class="col-sm-6">
                                        <x-form.input label="{{ __('Email') }}" type="email" name="email"
                                            value="{{ $admin->email }}" />
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <x-form.input label="{{ __('Address') }}" name="address"
                                            value="{{ $admin->address }}" />
                                    </div>
                                    <div class="col-sm-6">
                                        <x-form.input label="{{ __('Phone') }}" name="phone"
                                            value="{{ $admin->phone }}" />
                                    </div>
                                </div>
                            </div>
                            <x-form.submit submit="{{ __('Update') }}" reset="{{ __('Refresh') }}" />
                        </x-form.form>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card card-primary card-outline">
                        <x-form.form action="{{ route('admin.profiles.update.image', $admin->id) }}" hasFile
                            modMethod="PUT">

                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <x-form.show-image label="{{ __('Image') }}" src="{{ $admin->admin_image }}"
                                            alt="{{ $admin->name }}" />
                                    </div>
                                    <div class="col-sm-8">
                                        <x-form.file label="{{ __('Choose new image') }}" name="image" />
                                    </div>
                                </div>
                            </div>
                            <x-form.submit submit="{{ __('Update') }}" reset="{{ __('Refresh') }}" />
                        </x-form.form>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="card card-primary card-outline">
                        <x-form.form action="{{ route('admin.profiles.update.password', $admin->id) }}" hasFile
                            modMethod="PUT">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <x-form.input label="{{ __('Password') }}" type="password" name="password" />
                                    </div>
                                    <div class="col-sm-6">
                                        <x-form.input label="{{ __('Confirm Password') }}" type="password"
                                            name="password_confirm" />
                                    </div>
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
@endpush
