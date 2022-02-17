@extends('layouts.admin')

@push('title')
    {{ __('Thêm vai trò') }}
@endpush
@push('styles')
@endpush
@section('content')
    <div class="content">
        @include('admin.partials.header',[$title = 'Thêm mới vai trò', $current_page = 'Thêm vai trò'])
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary card-outline">
                        <x-form.form action="{{ route('admin.roles.store') }}">
                            @csrf
                            <div class="card-body">
                                <x-form.warning />
                                <div class="row">
                                    <div class="col-md-12">
                                        <x-form.input label="Tên vai trò :" name="name" placeholder="Nhập tên vai trò"
                                            required />
                                        <x-form.textarea label="Mô tả vai trò :" name="display_name" />
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <label>
                                            <input type="checkbox" class="checkall">
                                            CHỌN TẤT CẢ
                                        </label>
                                    </div>
                                    @foreach ($permissionsParent as $permissionsParentItem)
                                        <div class=" mb-3 col-md-6">
                                            <div class="card card-primary card-outline">
                                                <div class="card-header">
                                                    <label>
                                                        <input type="checkbox" value="" class="checkbox_wrapper">
                                                    </label>
                                                    <b>Module {{ $permissionsParentItem->name }}</b>
                                                </div>
                                                <div class="row">
                                                    @foreach ($permissionsParentItem->permissionsChildren as $permissionsChildrenItem)
                                                        <div class="card-body text-primary col-md-3">
                                                            <h5 class="card-title">
                                                                <label>
                                                                    <input type="checkbox" name="permission_id[]"
                                                                        class="checkbox_childrent input-check"
                                                                        value="{{ $permissionsChildrenItem->id }}">
                                                                </label>
                                                                <span
                                                                    class="ml-2">{{ $permissionsChildrenItem->name }}</span>
                                                            </h5>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
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
