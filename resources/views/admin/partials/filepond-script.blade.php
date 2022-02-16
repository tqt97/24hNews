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
        labelIdle: `Kéo và thả hình vào đây hoặc <span class="filepond--label-action">Chọn từ thiết bị</span>`,

        
        labelFileProcessing: 'Đang xử lý...',
        labelFileProcessingComplete:'Tải ảnh lên thành công',
        labelTapToUndo:'Chạm để hoàn tác',
        labelTapToCancel:'Chạm để hủy',


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
        labelFileTypeNotAllowed: 'Tệp tin không đúng định dạng jpg, png, gif, jpeg',
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
