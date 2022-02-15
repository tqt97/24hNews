@extends('layouts.admin')

@section('title', 'Chỉnh sửa vai trò')
@section('styles')
    <link rel="stylesheet" href="{{ asset('admin/plugins/select2/css/select2.min.css') }}">
@endsection
@section('content')
    <div class="content">
        @include('admin.partials.header',[$title = 'Chỉnh sửa vai trò', $current_page = 'Chỉnh sửa vai trò'])
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary card-outline">
                        <form action="{{ route('admin.roles.update', $role->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="card-body">
                                @include('admin.components.warning-top')
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Tên vai trò <code>*</code> :</label>
                                        <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" placeholder="Nhập tên vai trò"
                                            value="{{ $role->name }}">
                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label>Mô tả vai trò <code>*</code> :</label>
                                        <textarea class="form-control @error('display_name') is-invalid @enderror" name="display_name"
                                            rows="4">{{ $role->display_name }}</textarea>
                                        @error('display_name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>


                                </div>
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <label>
                                                <input type="checkbox" class="checkall">
                                                CHỌN TẤT CẢ
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
@endsection
