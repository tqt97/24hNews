@extends('layouts.admin')

@push('title')
    {{ __('Thêm tag') }}
@endpush
@section('content')
    <div class="content">
        @include('admin.partials.header',[$title = 'Thêm mới tag', $current_page = 'Thêm tag'])
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary card-outline">
                        <x-form.form action="{{ route('admin.tags.store') }}">
                            <div class="card-body">
                                <x-form.warning />
                                <x-form.input label="Tên tag" name="name" placeholder="Điền tên tag" required />
                            </div>
                            <x-form.submit submit="Thêm mới" reset="Làm mới" />
                        </x-form.form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
