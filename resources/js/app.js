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

let inputName = document.querySelector('input[name="name"]');
let inputDescription = document.querySelector('textarea[name="description"]');
let inputPrice = document.querySelector('input[name="price"]');
let inputMaker = document.querySelector('input[name="maker"]');
let inputQuantity = document.querySelector('input[name="quantity"]');


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
    imageValidateSizeLabelImageSizeTooSmall:'Image is too small',
    imageValidateSizeLabelImageSizeTooBig:'Image is too big',
    imageValidateSizeLabelExpectedMaxSize:'Maximum size is {maxWidth} × {maxHeight}',

    labelIdle: `Drag & Drop your picture or <span class="filepond--label-action">Browse</span>`,
    imagePreviewHeight: 170,
    styleLoadIndicatorPosition: 'center bottom',
    styleButtonRemoveItemPosition: 'center bottom'
});






$(document).ready(function() {
    $("#formProduct").submit(function(e) {
        //---------------^---------------
        e.preventDefault();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        const files = pond.getFiles()

        let myForm = document.getElementById('formProduct');
        var params = new FormData(myForm);
        params.delete("images[]")

        for ( var i in files) {
            params.append('images[]', files[i].file);
        }

        $.ajax({
            url: "/admin/products ",
            type: "POST",
            data: params,
            error:function ( jqXHR ) {

                let responseText = jQuery.parseJSON(jqXHR.responseText);
                if (jqXHR.status === 400) {
                    printErrorMsg(responseText.errors);
                } else if (jqXHR.status == 500) {
                    printErrorMsgText("Error en el servidor al procesar la solictud");
                }
            },
            success: function (data) {
                if($.isEmptyObject(data.errors)){
                    printSuccessMsg(data.success);
                }else{
                    printErrorMsg(data.errors);
                }
            },
            processData: false,
            contentType: false,
            dataType: 'json',
        });
    });
});

function printErrorMsgText (msg) {
    $("#listErrors").html('');
    $("#errors").css('display','block');
    $("#listErrors").append('<li>'+msg+'</li>');
}

function printErrorMsg (msg) {
    $("#listErrors").html('');
    $("#errors").css('display','block');
    $.each( msg, function(  value ) {
        $("#listErrors").append('<li>'+value+'</li>');
    });
}
function printSuccessMsg (msg) {
    $("#errors").css('display','none');
    pond.removeFiles();
    document.getElementById('formProduct').reset();

    $("#success-alerts").html('');
    $("#success-alerts").append(
        '<div class="alert alert-success h3" role="alert">\n' +
        '  <span><i class="fas fa-check-circle text-white font"></i></span>  ' +msg+
        ' </div> '
    );
    $("#success-alerts").css('display','block');
    $("#success-alerts").fadeTo(6000, 500).slideUp(500, function(){
        $("#success-alert").slideUp(500);
    });

}
