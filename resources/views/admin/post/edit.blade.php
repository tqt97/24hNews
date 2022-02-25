@extends('layouts.admin')

@push('title')
    {{ __('Update post') }}
@endpush
@push('styles')
    <link rel="stylesheet" href="{{ asset('admin/plugins/summernote/summernote-bs4.min.css') }}">
    @include('admin.partials.filepond-style')
@endpush
@section('content')
    <div class="content">
        <x-admin.header title="{{ __('Update post') }}" page="{{ __('Update post') }}" />
        <div class="container-fluid">
            <x-form.form action="{{ route('admin.posts.update', $post->id) }}" hasFile modMethod="PUT">
                <x-layouts.form-edit>
                    <x-layouts.general-left>
                        <x-form.input label="{{ __('Title') }}" name="title" value="{{ $post->title }}" />
                        <x-form.select label="{{ __('Choose category') }}" name="categories[]"
                            class="select2_category" required multiple>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}"
                                    {{ $categoryOfPost->contains('id', $category->id) ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </x-form.select>
                        <x-form.textarea label="{{ __('Description') }}" name="description"
                            value="{!! $post->description !!}" />
                        <x-form.textarea label="{{ __('Content') }}" name="content" value="{!! $post->content !!}" />
                    </x-layouts.general-left>
                    <x-layouts.general-right>
                        <x-form.show-image label="{{ __('Image') }}"
                            src="{{ $post->getFirstMediaUrl('posts', 'thumb') }}"
                            alt="{{ $post->name }}" />

                        <x-form.file label="{{ __('Choose new image') }}" name="image" />
                        <x-form.select label="{{ __('Tag') }}" name="tags[]" multiple class="select2_tag w-100"
                            required>
                            @foreach ($tags as $tag)
                                <option value="{{ $tag->name }}"
                                    {{ $tagOfPost->contains('id', $tag->id) ? 'selected' : '' }}>
                                    {{ $tag->name }}
                                </option>
                            @endforeach
                        </x-form.select>
                        <div class="row">
                            <div class="col-sm-6">
                                <x-form.checkbox-edit label="{{ __('Status') }}" name="status" display="{{ __('Show') }}"
                                    isChecked="{{ $post->status == 1 ? 'checked' : '' }}" />
                            </div>
                            <div class="col-sm-6">
                                <x-form.checkbox-edit label="{{ __('Highlight') }}" name="is_highlight"
                                    display="{{ __('Highlight') }}"
                                    isChecked="{{ $post->is_highlight == 1 ? 'checked' : '' }}" />
                            </div>
                        </div>
                    </x-layouts.general-right>
                </x-layouts.form-edit>
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
                tokenSeparators: [',', ' ']
            });
            $(".select2_category").select2({
                placeholder: "--- Chọn danh mục bài viết ---",
                allowClear: true
            });
            // $('#description').summernote({
            //     height: 80,
            //     codemirror: {
            //         theme: 'monokai'
            //     }
            // });
            $('#content').summernote({
                height: 150,
                codemirror: {
                    theme: 'monokai'
                }
            });
        });
    </script>
@endpush
