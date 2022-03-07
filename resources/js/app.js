require('./bootstrap');

import Alpine from 'alpinejs';
import * as FilePond from 'filepond';
import FilePondPluginFileValidateType from 'filepond-plugin-file-validate-type';
import FilePondPluginFileValidateSize from 'filepond-plugin-file-validate-size';
import FilePondPluginImageExifOrientation from 'filepond-plugin-image-exif-orientation';
import FilePondPluginImagePreview from 'filepond-plugin-image-preview';
import FilePondPluginImageEdit from 'filepond-plugin-image-edit';
import FilePondPluginImageCrop from 'filepond-plugin-image-crop';
import FilePondPluginImageTransform from 'filepond-plugin-image-transform';
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
    // corrects mobile image orientation
    FilePondPluginImageExifOrientation,
    // previews the image
    FilePondPluginImagePreview,
    // crops the image to a certain aspect ratio
    FilePondPluginImageCrop,
    // FilePondPluginImageEdit,
    // // applies crop and resize information on the client
    // FilePondPluginImageTransform,
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
// FilePond.setOptions({
//     server:'uploads',
//     // server: {
//     //     url: '/upload',
//     //     process: {
//     //         headers: {
//     //             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
//     //         }
//     //     }
//     // },
// });

/*
pond.setOptions({
    server:{
        url: 'http://127.0.0.1:8000/',
        process: 'upload',
        revert: '',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    }

});
*/



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
        console.log(files)

        let myForm = document.getElementById('formProduct');
        var params = new FormData(myForm);
        console.log("hay images? :  "+params.has("images[]"))


        for ( var i in files) {
            params.append('images[]', files[i].file);
        }
        console.log("images  es  ",params.getAll('images[]'))

        for (var pair of params.entries()) {
            console.log(pair[0]+ ',' + pair[1]);
        }
        $.ajax({
            url: "/admin/products ",
            type: "POST",
            data: params,
            error:function ( jqXHR, textStatus, errorThrown ) {
                // console.log('funtion Error ajax');
                // console.log(jqXHR);
                let responseText = jQuery.parseJSON(jqXHR.responseText);

                if (jqXHR.status === 400) {

                    printErrorMsg(responseText.errors);

                } else if (jqXHR.status == 500) {

                    printErrorMsgText("Error en el servidor al procesar la solictud");

                }

            },
            success: function (data) {
                console.log(data);
                if($.isEmptyObject(data.errors)){
                    console.log(data.success);

                    // console.log("files en pond ", pond.getFiles())
                    // console.log(document.querySelector('#files'))
                    // let myForm = document.getElementById('formProduct');
                    // var params = new FormData(myForm);
                    //
                    // for (var pair of params.entries()) {
                    //     console.log(pair[0]+ ',' + pair[1]);
                    // }
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
    console.log("entre al mensaje error  ");
    $("#listErrors").html('');
    $("#errors").css('display','block');

    $("#listErrors").append('<li>'+msg+'</li>');
}

function printErrorMsg (msg) {
    console.log("entre al mensaje error  ");
    $("#listErrors").html('');
    $("#errors").css('display','block');
    $.each( msg, function( key, value ) {
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
