var objMemberJoinAjax={},
    objMemberJoinEvents = {};

objMemberJoinAjax = {
    changePw: function () {                             //비밀번호변경
        var old_pw = $("#txt_old_pw").val(),
            new_pw = $("#txt_new_pw").val(),
            new_pw_confirm = $("#txt_new_pw_confirm").val(),
            id = $("#td_id").html();
 
        if (old_pw==='') {
            alert('기존 비밀번호를 입력하여 주세요.');
            $("#txt_old_pw").focus();
            return false;
        } else if (new_pw==='') {
            alert('새 비밀번호를 입력하여 주세요.');
            $("#txt_new_pw").focus();
            return false;
        } else if (new_pw_confirm==='') {
            alert('새 비밀번호확인을 입력하여 주세요.');
            $("#txt_new_pw_confirm").focus();
            return false;
        }
 // console.log(id, old_pw, new_pw);
        $.ajax({
            type: "POST",
            url: "/index.php/ajax_common",
            data: "p_id=" + id + "&p_old_pw=" + old_pw + "&p_up_code_cn=" + new_pw +"&p_target_name=btn_change_pw",
            success: function (msg) {
// console.log(msg);

                if (msg==='success') {
                    alert('비밀번호변경이 정상적으로 이루어졌습니다.');

                       $('#layer1').fadeOut();
                       event.preventDefault();
                } else {
                    alert('기존 비밀번호가 맞지 않습니다. 다시 입력하여 주십시요..');

                     $("#txt_old_pw").val('');
                     $("#txt_old_pw").focus();
                }
            },

            error: function (xhr, ajaxOptions, thrownError) {
                alert(thrownError);
            }
        });

    // return false;    
    } ,
        activeUser: function () {                             //가입승인
        var id = $("#td_id").html();
 
 // console.log(id);
        $.ajax({
            type: "POST",
            url: "/index.php/ajax_common",
            data: "p_id=" + id +"&p_target_name=btn_permit",
            success: function (msg) {
 // console.log(msg);
                if (msg==='success') {
                    alert('가입승인이 되었습니다.');
                    location.href = 'http://www.resortprice.co.kr/index.php/member/';
                } else {
                    alert('가입승인 되지 않았습니다. 관리자에게 문의바랍니다.');
                }
            },

            error: function (xhr, ajaxOptions, thrownError) {
                alert(thrownError);
            }
        });
    },

        deactiveUser: function () {                             //가입승인
        var id = $("#td_id").html();
 
 // console.log(id);
        $.ajax({
            type: "POST",
            url: "/index.php/ajax_common",
            data: "p_id=" + id +"&p_target_name=btn_deny",
            success: function (msg) {
 // console.log(msg);
                if (msg==='success') {
                    alert('계정이 중지되었습니다.');
                    location.href = 'http://www.resortprice.co.kr/index.php/member/';
                } else {
                    alert('계정이 중지되지 않았습니다. 관리자에게 문의바랍니다.');
                }
            },

            error: function (xhr, ajaxOptions, thrownError) {
                alert(thrownError);
            }
        });
    }

};

objMemberJoinEvents = {     //이메일 도메인 선택 셀랙트 박스
    changeEmailDomain: function () {
        if ($('#cbo_email_domain option:selected').val() === '0') {
            $('#txt_email_domain').val('');
            $('#txt_email_domain').focus();
            $('#txt_email_domain').attr('readonly', false);
        } else {
            $('#txt_email_domain').val($('#cbo_email_domain option:selected').text());
            $('#txt_email_domain').attr('readonly', true);
        }

// console.log($('#cbo_email_domain option:selected').val());
    },

    layerOpen : function (){        //레이어팝업
        var el = 'layer1';

        var temp = $('#' + el);     //레이어의 id를 temp변수에 저장
        var bg = temp.prev().hasClass('bg');    //dimmed 레이어를 감지하기 위한 boolean 변수

        if(bg){
            $('.layer').fadeIn();
        }else{
            temp.fadeIn();  //bg 클래스가 없으면 일반레이어로 실행한다.
        }

        // 화면의 중앙에 레이어를 띄운다.
        if (temp.outerHeight() < $(document).height() ) temp.css('margin-top', '-'+temp.outerHeight()/2+'px');
        else temp.css('top', '0px');
        if (temp.outerWidth() < $(document).width() ) temp.css('margin-left', '-'+temp.outerWidth()/2+'px');
        else temp.css('left', '0px');

        temp.find('a.cbtn').click(function(e){
            if(bg){
                $('.layer').fadeOut();
            }else{
                temp.fadeOut();     //'닫기'버튼을 클릭하면 레이어가 사라진다.
            }
            e.preventDefault();
        });

        $('.layer .bg').click(function(e){
            $('.layer').fadeOut();
            e.preventDefault();
        });

    },

    submitForm: function(){         //비밀번호변경
         var event = event || window.event,          //이벤트객체
        el = (typeof event.target !=='undefined') ? event.target : event.srcElement;           //소스 앨리먼트
// console.log(el.name);

        switch(el.name) {                     //버튼이름
        case 'btn_update':                  //정보수정
        $('#edit_member').submit();
            break;
        case 'btn_permit':                  //가입수정
            objMemberJoinAjax.activeUser();
        //document.edit_pw.submit();
            break;
         case 'btn_deny':                  //계정중지
            objMemberJoinAjax.deactiveUser();
        //document.edit_pw.submit();
            break;           
        case 'btn_change_pw':          //비밀번호변경
            objMemberJoinAjax.changePw();
            // if ($('#txt_old_pw').val()==='') {
            //     alert('이전 비밀번호를 입력하여 주십시요.');
            //     $('#txt_old_pw').focus();
            //     return false;
            // } else if ($('#txt_new_pw').val()==='') {
            //     alert('새 비밀번호를 입력하여 주십시요.');
            //     $('#txt_new_pw').focus();
            //     return false;
            // } else if ($('#txt_new_pw').val()==='') {
            //     alert('비밀번호확인을 입력하여 주십시요.');
            //     $('#txt_new_pw').focus();
            //     return false;
            // }
        //document.edit_pw.submit();

            break;
        }

        //document.edit_pw.submit();
    },
};
/*
*/
$(document).ready(function () { 
    //이벤트 핸들러 연결
    $('#btn_dupl_id').bind('click', objMemberJoinAjax.fnIdCheck);                      //ID중복확인
    
    $('.tel').bind('keypress', fnCommons.inputOnlyNumber);                                 //전화번호, 팩스 휴대폰 숫자만입력
    $('#dv_reg_no').bind('keypress', fnCommons.inputOnlyNumber);                  //사업자등록번호 숫자만입력
    $('#cbo_email_domain').bind('change', objMemberJoinEvents.changeEmailDomain);       //이메일 도메인 선택 셀랙트 박스 

    //$( '#txt_reg_no' ).live("blur keyup", function() {$(this).val( $(this).val().replace( /[ㄱ-ㅎ|ㅏ-ㅣ|가-힣]/g, '' ) );});
    $('#btn_update').bind('click', objMemberJoinEvents.submitForm);                                  //정보수정 버튼클릭
    $('#btn_permit').bind('click', objMemberJoinEvents.submitForm);                                   //가입승인 버튼클릭
    $('#btn_deny').bind('click', objMemberJoinEvents.submitForm);                                   //계정중지 버튼클릭
    $('#btn_change_pw').bind('click', objMemberJoinEvents.submitForm);                          //레이어팝업의 비밀번호변경 버튼클릭
    $('#btn_layer_pop').bind('click', objMemberJoinEvents.layerOpen);                                //비밀번호변경 버튼클릭
});
