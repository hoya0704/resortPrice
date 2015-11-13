var objBoardNoticeWriteAjax={},
        objBoardNoticeWriteEvent ={};

// objBoardNoticeWriteAjax = {
//     changeCboNation: function () {                             //국가선택 시
//         var p_up_code_cn = $("#cbo_nation").val();

//         $('#cbo_area').attr('disabled', false);

//         $.ajax({
//             type: "POST",
//             url: "/resortPrice/CI/index.php/ajax_common", //"<?php echo LOCAL_PATH ?>/ajax/Ajax_common",
//             data: "p_up_code_cn=" + p_up_code_cn,

//             success: function (msg) {
//                 $("#cbo_area").html('');
//                 $("#cbo_area").html('<option>-지역선택-</option>' + msg);
//                 //console.log(msg);
//             },
//             error: function (xhr, ajaxOptions, thrownError) {
//                 alert(thrownError);
//             }
//         });
//     },
// };

objBoardNoticeWriteEvent ={
    submitForm: function(){
        $('#write_board').submit();
    }
};

$(document).ready(function () {
     var editor = CKEDITOR.replace( 'txt_contents');
   // var editor = CKEDITOR.replace( 'txt_contents', {
   //      filebrowserUploadUrl: '../../upload'});

    // editor.on( 'change', function( evt ) {
    // // getData() returns CKEditor's HTML content.
    // console.log( 'Total bytes: ' + evt.editor.getData());
    // });

    //이벤트 핸들러 연결
    $('#btn_insert').bind('click', objBoardNoticeWriteEvent.submitForm);
});