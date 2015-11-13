var objResortListAjax={} ;          //ajax 객체

objResortListAjax = {
    clickBtnSearch: function () {                             //ID 중복체크
        var p_param = $("#txt_search_keyword").val(),
            event = event || window.event,          //이벤트객체
            eventTarget = (typeof event.target !=='undefined') ? event.target : event.srcElement;           //소스 앨리먼트

        $.ajax({
            type: "POST",
            url: "../php/ajax/ajaxResortList.php",
            data: "p_param=" + p_param,

            success: function (msg) {
                $("#dv_resort_list").html('');
                $("#dv_resort_list").html(msg);
                //console.log(msg);
            },
            error: function (xhr, ajaxOptions, thrownError) {
                alert(thrownError);
            }
        });
    }

};

$(document).ready(function () {
    //이벤트 핸들러 연결
    $('#btn_serach').bind('click', objAdminResortListAjax.clickBtnSearch);                                  //검색버튼클릭  
    $('#btn_serach').trigger('click');
});