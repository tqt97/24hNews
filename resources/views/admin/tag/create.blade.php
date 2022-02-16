@extends('layouts.admin')

@push('title')
    {{ __('Thêm tag') }}
@endpush
@push('content')
    <div class="content">
        @include('admin.partials.header',[$title = 'Thêm mới tag', $current_page = 'Thêm tag'])
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary card-outline">
                        <form action="{{ route('admin.tags.store') }}" method="POST">
                            @csrf
                            <div class="card-body">
                                @include('admin.components.warning-top')

                                <div class="form-group">
                                    <label>Tên tag <code>*</code> :</label>
                                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                                        value="{{ old('name') }}" placeholder="Điền tên tag" autofocus required>
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            @include('admin.components.card-footer-create')
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endpush
