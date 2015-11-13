var objReservationViewAjax={},
        objReservationViewEvent = {};
/* */
objReservationViewEvent = {
    clickSearchButton: function () {
        if($('#txt_keyword').val()==''){
            var act = '<?php echo LOCAL_PATH?>/index.php/reservation/lists/RESERVATION/';
        } else {
            var act = '<?php echo LOCAL_PATH?>/index.php/reservation/lists/RESERVATION/txt_keyword/' + $("#txt_keyword").val() + '/page/1';
        }
        $("#frm_search").attr('action', act).submit();
    },
};

objReservationViewAjax = {
    changeCboNation: function () {      //국가셀렉트박스 선택 시,
             
        var p_up_code_cn = $("#cbo_nation").val();
        
        if (p_up_code_cn === '0') {
            $('#cbo_area').attr('disabled', true);         
            $("#cbo_area").html('<option>-지역선택-</option>');   
            return false;
        }
        $('#cbo_area').attr('disabled', false);
//console.log('시작');
console.log(p_up_code_cn, $("#cbo_area").attr("name"));

        $.ajax({
            type: "POST",
            url: "/index.php/ajax_common", //"<?php echo LOCAL_PATH ?>/ajax/Ajax_common",
            data: "p_up_code_cn=" + p_up_code_cn + "&p_target_name=" + $("#cbo_area").attr("name") ,
            dataType: "html",

            success: function (msg) {
               $("#cbo_area").html('');
                $("#cbo_area").html('<option value="0">전체</option>' + msg);
 //              console.log(msg);
            },
            error: function (xhr, ajaxOptions, thrownError) {
                alert(thrownError);
            }
        });    
    },
    changeCboArea: function () {        //지역셀렉트박스 선택 시,
             
        var p_up_code_cn = $("#cbo_area").val();

        if (p_up_code_cn === '0') {
            $('#cbo_resort').attr('disabled', true);         
            $("#cbo_resort").html('<option>-리조트선택-</option>');   
            return false;
        }
        $('#cbo_resort').attr('disabled', false);

        $.ajax({
            type: "POST",
            url: "/index.php/ajax_common", //"<?php echo LOCAL_PATH ?>/ajax/Ajax_common",
            data: "p_up_code_cn=" + p_up_code_cn + "&p_target_name=" + $("#cbo_resort").attr("name") ,
            dataType: "html",

            success: function (msg) {
               $("#cbo_resort").html('');
                $("#cbo_resort").html('<option value="0">전체</option>' + msg);
               //console.log(msg);
            },
            error: function (xhr, ajaxOptions, thrownError) {
                alert(thrownError);
            }
        });    
    },


};

$(document).ready(function () {
    //이벤트 핸들러 연결
    $('#cbo_area').attr('disabled', true);
    $('#cbo_resort').attr('disabled', true);
    $('#cbo_nation').bind('change', objReservationViewAjax.changeCboNation);             //국가선택  
    $('#cbo_area').bind('change', objReservationViewAjax.changeCboArea);                    //지역선택 
    //$('#btn_search').bind('click', objReserveListEvent.clickSearchButton);                        //검색버튼 클릭
    //$('#btn_serach').trigger('click');

});