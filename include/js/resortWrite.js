var objResortWriteAjax={},
        objResortWriteEvent ={},
        objResortWriteVal = {};

        // objResortWriteVal = {
        //     room_rows: parseInt($('#hdn_room_rows').val(), 10)
        // };

        // seq = function() {
        //     var count = 0;
        //     return function(){
        //         return count+=1;
        //     }
        // };

objResortWriteAjax = {
    changeCboNation: function () {                             //국가선택 시
        var p_up_code_cn = $("#cbo_nation").val();

        if (p_up_code_cn === '0') {
        $('#cbo_area').attr('disabled', true);         
        $("#cbo_area").html('<option>-지역선택-</option>');   
            return false;
        }

        $('#cbo_area').attr('disabled', false);

        $.ajax({
            type: "POST",
            url: "/index.php/ajax_common", //"<?php echo LOCAL_PATH ?>/ajax/Ajax_common",
            data: "p_up_code_cn=" + p_up_code_cn,

            success: function (msg) {
                $("#cbo_area").html('');
                $("#cbo_area").html('<option>-지역선택-</option>' + msg);
                //console.log(msg);
            },
            error: function (xhr, ajaxOptions, thrownError) {
                alert(thrownError);
            }
        });
    },
};

objResortWriteEvent ={
    checkDivArea: function () {                             //리조트등록
        var event = event || window.event,              //이벤트객체
                    event_target = (typeof event.target !=='undefined') ? event.target : event.srcElement,      //소스 앨리먼트 
                    checked_vals ='';

        checked_vals = "";
        checked_vals = fnCommons.getChkedValues(event_target.name);

        switch(event_target.name) {       //하단버튼 상태
        case 'chk_room':
            $('#hdn_room_code_cns').val(checked_vals);
            break;
        case 'chk_meal':
            $('#hdn_meal_code_cns').val(checked_vals);
            break;
        case 'chk_vehicle':
            $('#hdn_vehicle_code_cns').val(checked_vals);
            break;
        }

//fnCommons.getChkedValues(event_target.name);
//console.log($('#hdn_room_type_code_cns').val()) + "</br>";
//console.log($('#hdn_meal_code_cns').val()) + "</br>";
//console.log($('#hdn_vehicle_code_cns').val()) + "</br>";        
//console.log(event_target.name) + "</br>";
 //       console.log(checked_vals);
    },

    clickDivRoomType: function () {                      //리조트등록
        var event = event || window.event,          //이벤트객체
                    event_target = (typeof event.target !=='undefined') ? event.target : event.srcElement,     //소스 앨리먼트 
                    add_html ='',
                    room_rows = 0;

        room_rows = parseInt($('#hdn_room_rows').val(), 10);        //룸타입 로우카운트

        add_html +='<tr>';
        add_html +='      <td>'+ (room_rows*3+1) +'</td>';
        add_html +='        <td><input type="text" style="width:90%" name="txt_room_type_'+ (room_rows + 1) +'_1" id="txt_room_type_'+ (room_rows + 1) +'_1"></td>';
        add_html +='        <td>'+ (room_rows*3+2) +'</td>';
        add_html +='        <td><input type="text" style="width:90%" name="txt_room_type_'+ (room_rows + 1) +'_2" id="txt_room_type_'+ (room_rows + 1) +'_2"></td>';
        add_html +='        <td>'+ (room_rows*3+3) +'</td>';
        add_html +='        <td><input type="text" style="width:90%" name="txt_room_type_'+ (room_rows + 1) +'_3" id="txt_room_type_'+ (room_rows + 1) +'_3"></td>';
        add_html +='        <td>';
        add_html +='                <button type="button" name="btn_add_line">+</button>';
        add_html +='                <button type="button" name="btn_del_line">-</button>';
        add_html +='        </td>';
        add_html +='    </tr>';

        switch(event_target.name) {       //dv_room_type div 태그의 하위 이벤트 대상 앨리먼트 지정 
        case 'btn_add_line':
            $('#tbl_room_type > tbody:last').append(add_html);
            $('#hdn_room_rows').val(room_rows + 1);
            
            // console.log($('#hdn_room_rows').val());
            break;
        case 'btn_del_line':
        if (room_rows!==1) {
            $('#tbl_room_type > tbody:last > tr:last').remove();
            $('#hdn_room_rows').val(room_rows - 1);
            }
            break;
        }
    },
    clickInsert: function() {
        var room_rows = 0,
            room_types = [],
            s_room_types ='',
            i_idx = 0;

         room_rows = parseInt($('#hdn_room_rows').val(), 10);        //룸타입 로우카운트
            for (var i_row = room_rows; i_row >= 1; i_row--) {
                for (var i_col = 3; i_col >= 1; i_col--) {
                    if ($('#txt_room_type_'+ i_row +'_'+i_col).val() !=='') {
                        room_types[i_idx] = $('#txt_room_type_'+ i_row +'_'+i_col).val();
                        i_idx +=1;
                    }
                }
            }
        s_room_types =room_types.join(',');
        $('#hdn_room_code_cns').val(s_room_types);
        $('#frm_resort').submit(); 
    }
    // rtnTotalrow: function (){
    //     total_row += 1;
    //     console.log(total_row);        
    // }
};

$(document).ready(function () {
    //이벤트 핸들러 연결
    $('#cbo_area').attr('disabled', true);
    $('#cbo_nation').bind('change', objResortWriteAjax.changeCboNation);                        //국가선택 

    $('#dv_room_checks').bind('click', objResortWriteEvent.checkDivArea);                          //객실타입 체크박스클릭
    // $('#dv_meal_checks').bind('click', objResortWriteEvent.checkDivArea);                       //식사타입 체크박스클릭
    $('#dv_vehicle_checks').bind('click', objResortWriteEvent.checkDivArea);                       //이동수단 체크박스클릭
    $('#dv_room_type').bind('click', objResortWriteEvent.clickDivRoomType);                      //식사타입 체크박스클릭
    $('#btn_insert').bind('click', objResortWriteEvent.clickInsert);                                           //입력
});