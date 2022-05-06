
require('./bootstrap');

import Alpine from 'alpinejs';

import * as FilePond from 'filepond';
import FilePondPluginFileValidateType from 'filepond-plugin-file-validate-type';
import FilePondPluginFileValidateSize from 'filepond-plugin-file-validate-size';
import FilePondPluginImageExifOrientation from 'filepond-plugin-image-exif-orientation';
import FilePondPluginImagePreview from 'filepond-plugin-image-preview';
import FilePondPluginImageCrop from 'filepond-plugin-image-crop';
import FilePondPluginImageResize from 'filepond-plugin-image-resize';
import FilePondPluginImageValidateSize from 'filepond-plugin-image-validate-size';

window.Alpine = Alpine;

Alpine.start();


const inputElement = document.querySelector('input[type="file"]');


FilePond.registerPlugin(
    FilePondPluginFileValidateType,
    FilePondPluginFileValidateSize,
    FilePondPluginImageExifOrientation,
    FilePondPluginImagePreview,
    FilePondPluginImageCrop,
    FilePondPluginImageResize,
    FilePondPluginImageValidateSize
);
const pond = FilePond.create( inputElement ,{
    credits:false,
    required:true,
    allowMultiple:true,
    allowReorder:true,
    // storeAsFile:true,
//     allowReorder:true,
    maxFiles:5,
    dropValidation:true,
    allowFileSizeValidation:true,
    maxFileSize:'2MB',
    allowFileTypeValidation:true,
    acceptedFileTypes: ['image/jpg,image/jpeg,image/png,image/bmp'],
    name:'images[]',
    allowImageExifOrientation:true,
    allowImagePreview:true,
    allowImageEdit:true,
    allowImageCrop:true,
    allowImageTransform:true,
    allowImageValidateSize:true,
    // imageValidateSizeMaxWidth:600,
    // imageValidateSizeMaxHeight:600,
    imageValidateSizeLabelImageSizeTooSmall:'Image is too small',
    imageValidateSizeLabelImageSizeTooBig:'Image is too big',
    imageValidateSizeLabelExpectedMaxSize:'Maximum size is {maxWidth} × {maxHeight}',

    labelIdle: `Drag & Drop your picture or <span class="filepond--label-action">Browse</span>`,
    imagePreviewHeight: 170,
    // imageCropAspectRatio: '1:1',
    // imageResizeTargetWidth: 200,
    // imageResizeTargetHeight: 200,
    // stylePanelLayout: 'compact circle',
    styleLoadIndicatorPosition: 'center bottom',
    styleButtonRemoveItemPosition: 'center bottom'
});


window.filepond=require('filepond');
