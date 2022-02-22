@extends('layouts.admin')

@push('title')
    {{ __('Thêm danh mục') }}
@endpush
@push('styles')
    @include('admin.partials.filepond-style')
@endpush
@section('content')
    <div class="content">
        @include('admin.partials.header',[$title = 'Thêm mới danh mục', $current_page = 'Thêm danh mục'])
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary card-outline">
                        <x-form.form action="{{ route('admin.categories.store') }}" hasFile>
                            <div class="card-body">
                                <x-form.warning/>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <x-form.input label="Tên danh mục :"  name="name" required/>
                                    </div>
                                    <div class="col-sm-6">
                                        <x-form.select label="Chọn danh mục (Mặc định là danh mục gốc) :"  name="parent_id" required class="select2_category">
                                            <option value="0">|-- Danh mục gốc</option>
                                                {!! $htmlOption !!}
                                        </x-form.select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <x-form.file label="Hình đại diện :"  name="image" required/>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <x-form.status label="Trạng thái :"  name="status" display="Hiển thị" checked/>
                                    </div>
                                    <div class="col-sm-6">
                                        <x-form.status label="Nổi bật :" name="is_highlight" display="Nổi bật"/>
                                    </div>
                                </div>
                            </div>
                            <x-form.submit  submit="Thêm mới" reset="Làm mới"/>
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
            $(".select2_category").select2({
                placeholder: "--- Chọn danh mục ---",
                allowClear: true
            });
        });
    </script>
@endpush
