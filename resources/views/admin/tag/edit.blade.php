@extends('layouts.admin')

@push('title')
    {{ __('Sửa tag') }}
@endpush
@push('styles')
@endpush
@section('content')
    <div class="content">
        @include('admin.partials.header',[$title = 'Sửa tag', $current_page = 'Sửa tag'])
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary card-outline">
                        <x-form.form action="{{ route('admin.tags.update', $tag->id) }}" modMethod="PUT">
                            <div class="card-body">
                                <x-form.warning />
                                <x-form.input label="Tên tag :" name="name" value="{{ $tag->name }}" required />
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
@endpush
