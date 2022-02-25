@extends('layouts.admin')

@push('title')
    {{ __('Add post') }}
@endpush
@push('styles')
    <link rel="stylesheet" href="{{ asset('admin/plugins/summernote/summernote-bs4.min.css') }}">
    @include('admin.partials.filepond-style')
@endpush
@section('content')
    <div class="content">
        <x-admin.header title="{{ __('Add post') }}" page="{{ __('Add post') }}" />
        <div class="container-fluid">
            <x-form.form action="{{ route('admin.posts.store') }}" hasFile>
                <x-layouts.form-create>
                    <x-layouts.general-left>
                        <x-form.input label="{{ __('Title') }}" name="title" placeholder="{{ __('Fill the title') }}"
                            required />
                        <x-form.select label="{{ __('Choose category') }}" name="categories[]" multiple
                            class="select2_category" required>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </x-form.select>
                        <x-form.textarea label="{{ __('Description') }}" name="description" required/>
                        <x-form.textarea label="{{ __('Content') }}" name="content" required/>
                    </x-layouts.general-left>
                    <x-layouts.general-right>
                        <x-form.file label="{{ __('Image') }}" name="image" required />
                        <x-form.select label="{{ __('Tag') }}" name="tags[]" multiple class="select2_tag w-100">
                            @foreach ($tags as $tag)
                                <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                            @endforeach
                        </x-form.select>
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
    <script src="{{ asset('admin/plugins/summernote/summernote-bs4.min.js') }}"></script>
    @include('admin.partials.filepond-script')
    <script>
        $(function() {
            $(".select2_tag").select2({
                tags: true,
                allowClear: true,
                tokenSeparators: [',', ' ']
            });
            $(".select2_category").select2({
                placeholder: "{{ __('Choose category') }}",
                tokenSeparators: [',', ' '],
                allowClear: true
            });
            $('#content').summernote({
                height: 150,
                codemirror: {
                    theme: 'monokai'
                }
            });
        });
    </script>
@endpush
