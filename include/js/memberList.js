var objMemberListAjax={},           //ajax 객체
    objMemberListEvent = {};         //event 객체

objAdminMakeResortEvent = {
/*
    changeCboNation: function () {
        if ($('#btn_nation').val() !== '0') {
            $('#cbo_area').attr('disabled', 'true');
        }
    },
*/
    loopTableTr: function(index, item) {        //미승인 행 빨간색 처리.
            //$('tr').css('color', 'red');
            // console.log(index, value);
            //if ($("td:eq(7)").html() =="미승인") {
            //} 
        var $_table_tr = $('#tb_member_list tr'),
        rowCount = $_table_tr.length - 1 ;
        for (var i = rowCount - 1; i > 0; i--) {
// console.log(i, $('#tb_member_list tr:eq('+ i +') td:eq(7)').html());
            $('#tb_member_list  .hyper_title').css('color', 'blue');

              if ($('#tb_member_list tr:eq('+ i +') td:eq(7)').html() === '미승인' || $('#tb_member_list tr:eq('+ i +') td:eq(7)').html() === '계정중지'){
                $('#tb_member_list tr:eq('+ i +')  td').css('color', 'red');
                //$('#tb_member_list  a').css('color', 'red');
              } else {
                $('#tb_member_list tr:eq('+ i +') td').css('color', 'black');
                //$('#tb_member_list  a').css('color', 'black');
              }
          };  
    }

};

objMemberListAjax = {
    clickBtnSearch: function () {                             //ID 중복체크
        var p_param = $("#txt_search_keyword").val();
            event = event || window.event,          //이벤트객체
            eventTarget = (typeof event.target !=='undefined') ? event.target : event.srcElement;           //소스 앨리먼트

 /*       
        if (p_up_code_cn === '0') {
        $('#cbo_area').attr('disabled', true);         
        $("#cbo_area").html('<option>-지역선택-</option>');   
            return false;
        }
//console.log(p_up_code_cn);


        $.ajax({
            type: "POST",
            url: "../php/ajax/ajaxMemberList.php",
            data: "p_param=" + p_param,

            success: function (msg) {
                $("#dv_member_list").html('');
                $("#dv_member_list").html(msg);
                //console.log(msg);
            },
            error: function (xhr, ajaxOptions, thrownError) {
                alert(thrownError);
            }
        });
 */
    },

};

$(document).ready(function () {
//console.log($('tr td:nth-child('+index+')'.html)
    //이벤트 핸들러 연결
    $('#btn_serach').bind('click', objMemberListAjax.clickBtnSearch);                                  //검색버튼클릭  
    $('#btn_serach').trigger('click');
    //$('#tb_member_list tr').each(function(index, item){console.log($("td:nth-child(9)").html(), index); if ($("td:eq(7)").html() ==="미승인") {$('td').css('color', 'red');} });
    //$('#tb_member_list tr').each(objAdminMakeResortEvent.loopTableTr());
objAdminMakeResortEvent.loopTableTr();
});