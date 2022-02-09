@extends('admin.layouts.base')

@section('title', 'Thêm vai trò')
@section('styles')
    <link rel="stylesheet" href="{{ asset('admin/plugins/select2/css/select2.min.css') }}">
@endsection
@section('content')
    <div class="content">
        @include('admin.layouts.partials.header',[$title = 'Thêm mới vai trò', $current_page = 'Thêm vai trò'])
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary-outline">
                        <form action="{{ route('admin.role.store') }}" method="POST">
                            @csrf
                            <div class="card-body">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Tên vai trò :</label>
                                        <input type="text" class="form-control" name="name" placeholder="Nhập tên vai trò"
                                            value="{{ old('name') }}">
                                    </div>
                                    <div class="form-group">
                                        <label>Mô tả vai trò :</label>
                                        <textarea class="form-control" name="display_name"
                                            rows="2">{{ old('display_name') }}</textarea>
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
                                                    <b>Module {{ $permissionsParentItem->name }}</b>
                                                </div>
                                                <div class="row">
                                                    @foreach ($permissionsParentItem->permissionsChildrent as $permissionsChildrentItem)
                                                        <div class="card-body text-primary col-md-3">
                                                            <h5 class="card-title">
                                                                <label>
                                                                    <input type="checkbox" name="permission_id[]"
                                                                        class="checkbox_childrent"
                                                                        value="{{ $permissionsChildrentItem->id }}">
                                                                </label>
                                                                {{ $permissionsChildrentItem->name }}
                                                            </h5>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            @include('admin.src.components.card-footer-create')
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
