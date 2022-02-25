@extends('layouts.admin')

@push('title')
    {{ __('Update slider') }}
@endpush
@push('styles')
    @include('admin.partials.filepond-style')
@endpush
@section('content')
    <div class="content">
        <x-admin.header title="{{ __('Update slider') }}" page="{{ __('Update slider') }}" />
        <div class="container-fluid">
            <x-form.form action="{{ route('admin.sliders.update', $slider->id) }}" modMethod="PUT" hasFile>
                <x-layouts.form-edit>
                    <x-layouts.general-left>
                        <x-form.input label="{{ __('Title') }}" name="title" value="{{ $slider->title }}" required />
                        <x-form.input label="{{ __('URL') }}" name="url" value="{{ $slider->url }}" />
                        <x-form.textarea label="{{ __('Description') }}" name="description"
                            value="{!! $slider->description !!}" />
                    </x-layouts.general-left>
                    <x-layouts.general-right>
                        <x-form.show-image label="{{ __('Image') }}"
                            src="{{ $slider->getFirstMediaUrl('sliders', 'thumb') }}" alt="{{ $slider->title }}" />
                        <x-form.file label="{{ __('Choose new image') }}" name="image" />
                        <x-form.input label="{{ __('Order') }}" type="number" name="order"
                            value="{{ $slider->order }}" />
                        <x-form.checkbox-edit label="{{ __('Status') }}" name="status" display="{{ __('Show') }}"
                            isChecked="{{ $slider->status === 1 ? 'checked' : '' }}" />
                    </x-layouts.general-right>
                </x-layouts.form-edit>
            </x-form.form>
        </div>
    </div>
@endsection
@push('scripts')
    @include('admin.partials.filepond-script')
@endpush
