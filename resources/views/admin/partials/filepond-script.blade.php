<script src="https://unpkg.com/filepond-plugin-image-validate-size/dist/filepond-plugin-image-validate-size.js">
</script>

<script src="https://unpkg.com/filepond-plugin-file-validate-type/dist/filepond-plugin-file-validate-type.js"></script>
<script src="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.js"></script>

<script src="https://unpkg.com/filepond/dist/filepond.min.js"></script>

<script>
    const inputElement = document.querySelector('input[id="image"]');
    FilePond.registerPlugin(
        FilePondPluginImagePreview,
        FilePondPluginFileValidateType,
        FilePondPluginImageValidateSize
    );
    const pond = FilePond.create(inputElement, {
        // labelIdle: `Kéo và thả hình vào đây hoặc <span class="filepond--label-action">Chọn từ thiết bị</span>`,
        labelIdle: `{{ __('Drag and drop your files or browse your computer') }}`,


        labelFileProcessing: `{{ __('Processing...') }}`,
        labelFileProcessingComplete: `{{ __('Upload successfully') }}`,
        labelTapToUndo: `{{ __('Touch to undo') }}`,
        labelTapToCancel: `{{ __('Touch to cancel') }}`,


        imagePreviewHeight: 100,
        imageCropAspectRatio: '1:1',
        imageResizeTargetWidth: 300,
        imageResizeTargetHeight: 300,
        // stylePanelLayout: 'compact circle',
        styleLoadIndicatorPosition: 'center bottom',
        styleProgressIndicatorPosition: 'right bottom',
        styleButtonRemoveItemPosition: 'left bottom',
        styleButtonProcessItemPosition: 'right bottom',

        acceptedFileTypes: ['image/*'],
        labelFileTypeNotAllowed: "{{ __('Image type must beImage type must be') }} jpg, png, gif, jpeg",
        imageValidateSizeMaxWidth: 2000,
        imageValidateSizeMaxHeight: 1000,
        imageValidateSizeMinWidth: 300,
        imageValidateSizeMinHeight: 200,

    });
    FilePond.setOptions({
        server: {
            url: '/admin',
            process: '/upload',
            revert: '/upload/delete',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        }
    });
</script>
