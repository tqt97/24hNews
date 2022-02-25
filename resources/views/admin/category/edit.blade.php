@extends('layouts.admin')

@push('title')
    {{ __('Update category') }}
@endpush
@push('styles')
    @include('admin.partials.filepond-style')
@endpush
@section('content')
    <div class="content">
        <x-admin.header title=" {{ __('Update category') }}" page=" {{ __('Update') }}" />
        <div class="container-fluid">
            <x-form.form action="{{ route('admin.categories.update', $category->id) }}" hasFile modMethod="PUT">
                <x-layouts.form-edit>
                    <x-layouts.general-left>

                        <x-form.input label="{{ __('Category name') }}" name="name" value="{{ $category->name }}" />

                        <x-form.select label="{{ __('Choose category') }}" name="parent_id" class="select2_category">
                            <option value="0">{{ __('Category root') }}</option>
                            {!! $htmlOption !!}
                        </x-form.select>
                    </x-layouts.general-left>
                    <x-layouts.general-right>
                        <x-form.show-image label="{{ __('Image') }}"
                            src="{{ $category->getFirstMediaUrl('categories', 'thumb') }}"
                            alt="{{ $category->name }}" />
                        <x-form.file label="{{ __('Choose new image') }}" name="image" />
                        <div class="row">
                            <div class="col-sm-6">
                                <x-form.checkbox-edit label="{{ __('Status') }}" name="status"
                                    display="{{ __('Show') }}"
                                    isChecked="{{ $category->status == 1 ? 'checked' : '' }}" />
                            </div>
                            <div class="col-sm-6">
                                <x-form.checkbox-edit label="{{ __('Highlight') }}" name="is_highlight"
                                    display="{{ __('Highlight') }}"
                                    isChecked="{{ $category->is_highlight == 1 ? 'checked' : '' }}" />
                            </div>
                        </div>
                    </x-layouts.general-right>
                </x-layouts.form-edit>
            </x-form.form>
        </div>
    </div>
@endsection
@push('scripts')
    @include('admin.partials.filepond-script')

    <script>
        $(function() {
            $(".select2_category").select2({
                placeholder: "{{ __('Choose category') }}",
                allowClear: true
            });
        });
    </script>
@endpush
