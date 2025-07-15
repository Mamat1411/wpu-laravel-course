import * as FilePond from 'filepond';
import FilePondPluginImagePreview from 'filepond-plugin-image-preview';
import FilePondPluginFileValidateType from 'filepond-plugin-file-validate-type';
import FilePondPluginFileValidateSize from 'filepond-plugin-file-validate-size';
import FilePondPluginImageTransform from 'filepond-plugin-image-transform';
import FilePondPluginImageResize from 'filepond-plugin-image-resize';

FilePond.registerPlugin(
    FilePondPluginImagePreview,
    FilePondPluginFileValidateType,
    FilePondPluginFileValidateSize,
    FilePondPluginImageTransform,
    FilePondPluginImageResize
);

const inputElement = document.querySelector('#avatar');
if (inputElement) {
    FilePond.create(inputElement, {
        acceptedFileTypes: ['image/png', 'image/jpg', 'image/jpeg'],
        maxFileSize: '10MB',
        imageResizeTargetWidth: 600,
        imageResizeMode: 'contain',
        imageResizeUpscale: false,
        server: {
            url: window.uploadUrl,
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            }
        }
    });
}
