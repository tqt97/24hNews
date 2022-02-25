@extends('layouts.admin')

@push('title')
    {{ __('Add new category') }}
@endpush
@push('styles')
    @include('admin.partials.filepond-style')
@endpush
@section('content')
    <div class="content">
        <x-admin.header title="{{ __('Add new category') }}" page="{{ __('Add new category') }}" />
        <div class="container-fluid">
            <x-form.form action="{{ route('admin.categories.store') }}" hasFile>
                <x-layouts.form-create>
                    <x-layouts.general-left>
                        <x-form.input label="{{ __('Category name') }}" name="name" required />
                        <x-form.select label="{{ __('Choose category') }}" name="parent_id" required
                            class="select2_category">
                            <option value="0">{{ __('Category root') }}</option>
                            {!! $htmlOption !!}
                        </x-form.select>
                    </x-layouts.general-left>
                    <x-layouts.general-right>
                        <x-form.file label="{{ __('Image') }}" name="image" required />
                        <div class="row">
                            <div class="col-sm-6">
                                <x-form.checkbox label="{{ __('Status') }}" name="status" display="{{ __('Show') }}"
                                    checked />
                            </div>
                            <div class="col-sm-6">
                                <x-form.checkbox label="{{ __('Highlight') }}" name="is_highlight"
                                    display="{{ __('Highlight') }}" />
                            </div>
                        </div>
                    </x-layouts.general-right>
                </x-layouts.form-create>
            </x-form.form>
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
