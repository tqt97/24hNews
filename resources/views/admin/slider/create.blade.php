@extends('layouts.admin')

@push('title')
    {{ __('Add slider') }}
@endpush
@push('styles')
    @include('admin.partials.filepond-style')
@endpush
@section('content')
    <div class="content">
        <x-admin.header title="{{ __('Add slider') }}" page="{{ __('Add slider') }}" />
        <div class="container-fluid">
            <x-form.form action="{{ route('admin.sliders.store') }}" hasFile>
                <x-layouts.form-create>
                    <x-layouts.general-left>
                        <x-form.input label="{{ __('Title') }}" name="title" required />
                        <x-form.input label="{{ __('URL') }}" name="url" />
                        <x-form.textarea label="{{ __('Description') }}" name="description" />
                    </x-layouts.general-left>
                    <x-layouts.general-right>
                        <div class="col-sm-12">
                            <x-form.file label="{{ __('Image') }}" name="image" required />
                        </div>
                        <x-form.input label="{{ __('Order') }}" type="number" name="order" value="0"
                            placeholder="{{ __('Default 0') }}" />
                        <x-form.checkbox label="{{ __('Status') }}" name="status" display="{{ __('Show') }}"
                            checked />
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
