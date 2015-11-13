var objReservationWriteAjax={},
        objReservationWriteEvent = {};
/* */
objReservationWriteGlobalVal = {        //공용변수
    objElment: {
        spinner : '#spinner'        //spinner 앨리먼트
    },
};

objReservationWriteEvent = {                    
    calNightDay: function () {           //숙박일 계산
        var datepicker1_val = $('#datepicker1').val(),
            datepicker2_val = $('#datepicker2').val();
if (datepicker1_val < datepicker2_val) {
        $('#spinner').val(fnCommons.calDateRange(datepicker1_val, datepicker2_val));    
} else {
    alert('체크인 일자가 체크아웃 일자보다 나중일 수는 없습니다.');
    $('#datepicker2').val('');
    $('#spinner').val('');
}
    }
};

objReservationWriteAjax = {
    changeCboNation: function () {      //국가셀렉트박스 선택 시,
             
        var p_up_code_cn = $("#cbo_nation").val();
        
        if (p_up_code_cn === '0') {
            $('#cbo_area').attr('disabled', true);         
            $("#cbo_area").html('<option>-지역선택-</option>');   
            return false;
        }
        $('#cbo_area').attr('disabled', false);
//console.log('시작');
//console.log(p_up_code_cn, $("#cbo_area").attr("name"));

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
                $("#cbo_resort").html('<option value="0">리조트선택</option>' + msg);
               //console.log(msg);
            },
            error: function (xhr, ajaxOptions, thrownError) {
                alert(thrownError);
            }
        });    
    },
    changeCboResort: function () {        //리조트셀렉트박스 선택 시,
             
        var p_resort_cn = $("#cbo_resort").val();
// console.log(p_resort_cn);
// console.log($("#cbo_room").attr("name"));

        if (p_resort_cn === '0') {
            $('#cbo_room').attr('disabled', true);         
            $("#cbo_room").html('<option>-객실타입선택-</option>');   

            //$('#cbo_meal').attr('disabled', true);         
            //$("#cbo_meal").html('<option>-식사타입선택-</option>');   

            //$('#cbo_vehicle').attr('disabled', true);         
            //$("#cbo_vehicle").html('<option>-이동수단선택-</option>');   
        return false;
        }
        $('#cbo_room').attr('disabled', false);
        //$('#cbo_meal').attr('disabled', false);
        //$('#vehicle').attr('disabled', false);

        $.ajax({
            type: "POST",
            url: "/index.php/ajax_common", //"<?php echo LOCAL_PATH ?>/ajax/Ajax_common",
            data: "p_up_code_cn=" + p_resort_cn + "&p_target_name=" + $("#cbo_room").attr("name") ,
            dataType: "html",

            success: function (msg) {
               $("#cbo_room").html('');
                $("#cbo_room").html('<option value="0">성공</option>' + msg);
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
    $( "#spinner" ).spinner({ 
        min: 1, 
        max: 30,
        spin: function( event, ui ) {
            var night_cnt = ui.value,
                    checkin_date,
                    checkout_date,
                    checkout_year,
                    checkout_month,
                    checkout_day;
        checkin_date = new Date($('#datepicker1').val());
        checkout_date = new Date();
        checkout_date.setDate(checkin_date.getDate() + night_cnt);
        checkout_year = checkout_date.getFullYear();
        checkout_month =  (checkout_date.getMonth()+1)>9 ? ''+(checkout_date.getMonth()+1) : '0'+(checkout_date.getMonth()+1);
        checkout_day = checkout_date.getDate()>9 ? ''+checkout_date.getDate() : '0'+checkout_date.getDate();
        //$( this ).spinner( "value", "Number " + 7 );
        checkout_date = checkout_year + '-' +checkout_month + '-' + checkout_day;
        // console.log(checkout_date);
        $('#datepicker2').val(checkout_date);
        }
    });

    $('#cbo_area').attr('disabled', true);
    $('#cbo_resort').attr('disabled', true);

    $('#cbo_nation').bind('change', objReservationWriteAjax.changeCboNation);             //국가선택  
    $('#cbo_area').bind('change', objReservationWriteAjax.changeCboArea);                    //지역선택 
    $('#cbo_resort').bind('change', objReservationWriteAjax.changeCboResort);                           //리조트선택     
    // $('#spinner').bind('change', objReservationWriteEvent.changeSpinnerValue);                           //     
    //$('#btn_serach').trigger('click');
    $('#datepicker2').bind('change', objReservationWriteEvent.calNightDay);                           //체크아웃선택
});


 /*
$(function() {
    var spinner = $( "#spinner" ).spinner();

    $( "#disable" ).click(function() {
      if ( spinner.spinner( "option", "disabled" ) ) {
        spinner.spinner( "enable" );
      } else {
        spinner.spinner( "disable" );
      }
    });
    $( "#destroy" ).click(function() {
      if ( spinner.spinner( "instance" ) ) {
        spinner.spinner( "destroy" );
      } else {
        spinner.spinner();
      }
    });
    $( "#getvalue" ).click(function() {
      alert( spinner.spinner( "value" ) );
    });
    $( "#setvalue" ).click(function() {
      spinner.spinner( "value", 5 );
    });
 
    $( "button" ).button();

  });
      */