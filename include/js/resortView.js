var objResortViewAjax={},
    objResortViewEvent={},
    objResortViewProc={};

objResortViewEvent ={
    checkDivArea: function () {                             //체크된 체크박스 code_cn값들을 히든필드에 찍어준다.
        var event = event || window.event,          //이벤트객체
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
    },
};

objResortViewProc ={
    checkCheckbox: function (p_checkbox_name, p_target_hiddenfield_id) {
        var array_code_cn = $('#' + p_target_hiddenfield_id).val();
        array_code_cn = array_code_cn.split(',');
//console.log(array_code_cn);


        //$('#' + p_target_hiddenfield).val().split(',');
    $('input:checkbox[name='+ p_checkbox_name +']').each(function() {
        for (var i = array_code_cn.length - 1; i >= 0; i--) {
            if (array_code_cn[i] === this.value)
            {
                this.checked = true; //checked 처리
            }
        }
     });
    }
};


objResortViewAjax = {
    /*
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
            url: "../php/ajax/commonSelectbox.php",
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
   */   
};

$(document).ready(function () {
    //이벤트 핸들러 연결
    //$('#cbo_area').attr('disabled', true);
    //$('#cbo_nation').bind('change', objAdminMakeResortAjax.changeCboNation);                //국가선택  
    //$('#btn_area').bind('click', objAdminMakeResortAjax.clickBtnArea);                                  //버튼클릭
    objResortViewProc.checkCheckbox('chk_room', 'hdn_room_code_cns');
    objResortViewProc.checkCheckbox('chk_meal', 'hdn_meal_code_cns');
    objResortViewProc.checkCheckbox('chk_vehicle', 'hdn_vehicle_code_cns');

    $('#dv_room_checks').bind('click', objResortViewEvent.checkDivArea);                                  //객실타입 체크박스클릭
    $('#dv_meal_checks').bind('click', objResortViewEvent.checkDivArea);                                  //식사타입 체크박스클릭
    $('#dv_vehicle_checks').bind('click', objResortViewEvent.checkDivArea);                                  //이동수단 체크박스클릭});
});


