@extends('layouts.admin')

@section('title', 'Thêm vai trò')
@section('styles')
    <link rel="stylesheet" href="{{ asset('admin/plugins/select2/css/select2.min.css') }}">
@endsection
@section('content')
    <div class="content">
        @include('admin.partials.header',[$title = 'Thêm mới vai trò', $current_page = 'Thêm vai trò'])
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary card-outline">
                        <form action="{{ route('admin.roles.store') }}" method="POST">
                            @csrf
                            <div class="card-body">
                                @include('admin.components.warning-top')

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Tên vai trò <code>*</code>:</label>
                                            <input type="text" class="form-control @error('name') is-invalid @enderror"
                                                name="name" placeholder="Nhập tên vai trò" value="{{ old('name') }}">
                                            @error('name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label>Mô tả vai trò <code>*</code>:</label>
                                            <textarea class="form-control @error('display_name') is-invalid @enderror"
                                                name="display_name" rows="2">{{ old('display_name') }}</textarea>
                                            @error('display_name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <label>
                                            <input type="checkbox" class="checkall">
                                            CHỌN TẤT CẢ
                                        </label>
                                    </div>
                                    {{-- <div class="col-sm-6"> --}}
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
                                    {{-- </div> --}}
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
