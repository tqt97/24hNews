@extends('layouts.admin')

@section('title', 'Thêm quyền')

@section('content')
    <div class="content">
        @include('admin.partials.header',[$title = 'Thêm mới quyền', $current_page = 'Thêm quyền'])
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary-outline">
                        <form action="{{ route('admin.permissions.store') }}" method="POST">
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label>Chọn module :</label>
                                    <select class="form-control select2_permission" name="module_parent">
                                        <option></option>
                                        @foreach (config('permissions.table_module') as $moduleItem)
                                            <option value="{{ $moduleItem }}">{{ $moduleItem }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        @foreach (config('permissions.module_childrent') as $moduleItemChilrent)
                                            <div class="col-md-3">
                                                <label>
                                                    <input type="checkbox" value="{{ $moduleItemChilrent }}"
                                                        name="module_chilrent[]">
                                                    {{ $moduleItemChilrent }}
                                                </label>
                                            </div>
                                        @endforeach

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
@section('scripts')

    <script>
        $(function() {
            $(".select2_permission").select2({
                placeholder: "--- Chọn module ---",
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