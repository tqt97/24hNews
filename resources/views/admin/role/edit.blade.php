@extends('layouts.admin')

@push('title')
    {{ __('Edit role') }}
@endpush
@push('styles')
@endpush
@section('content')
    <div class="content">
        <x-admin.header title="{{ __('Edit role') }}" page="{{ __('Edit role') }}" />
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary card-outline">
                        <x-form.form action="{{ route('admin.roles.update', $role->id) }}" modMethod="PUT">
                            <div class="card-body">
                                <x-form.warning />
                                <div class="col-md-12">
                                    <x-form.input label="{{ __('Name') }}" name="name" value="{{ $role->name }}" />

                                    <x-form.textarea label="{{ __('Description') }}" name="display_name"
                                        value="{{ $role->display_name }}" />
                                </div>
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <label>
                                                <input type="checkbox" class="checkall">
                                                {{ __('Select all') }}
                                            </label>
                                        </div>

                                        @foreach ($permissionsParent as $permissionsParentItem)
                                            <div class="card border-primary mb-3 col-md-12">
                                                <div class="card-header">
                                                    <label>
                                                        <input type="checkbox" value="" class="checkbox_wrapper">
                                                    </label>
                                                    <b> Module {{ $permissionsParentItem->name }}</b>
                                                </div>
                                                <div class="row">
                                                    @foreach ($permissionsParentItem->permissionsChildren as $permissionsChildrenItem)
                                                        <div class="card-body text-primary col-md-3">
                                                            <h5 class="card-title">
                                                                <label>
                                                                    <input type="checkbox" name="permission_id[]"
                                                                        {{ $pemissionsChecked->contains('id', $permissionsChildrenItem->id) ? 'checked' : '' }}
                                                                        class="checkbox_childrent"
                                                                        value="{{ $permissionsChildrenItem->id }}">
                                                                </label>
                                                                {{ $permissionsChildrenItem->name }}
                                                            </h5>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        @endforeach
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
    <script>
        $(function() {
            $(".select2_role").select2({
                placeholder: "--- Chọn role ---",
                allowClear: true
            });
        });
        $(function() {
            $('.checkbox_wrapper').on('click', function() {
                $(this).parents('.card').find('.checkbox_childrent').prop('checked', $(this).prop(
                    'checked'));
            });

            $('.checkall').on('click', function() {
                $(this).parents().find('.checkbox_childrent').prop('checked', $(this).prop('checked'));
                $(this).parents().find('.checkbox_wrapper').prop('checked', $(this).prop('checked'));

            });
        });
    </script>
@endpush
