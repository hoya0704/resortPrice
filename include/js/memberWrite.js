var objMemberJoinAjax={},
    objMemberJoinEvents = {};


objMemberJoinAjax = {
    fnIdCheck: function () {                             //ID 중복체크
        var p_curr_id = $("#txt_id").val();
 //console.log(p_curr_id);
        if (p_curr_id==='') {
            alert('아이디를 입력하여 주십시요.');
            $("#txt_id").focus();
            return false;
        } 

        $.ajax({
            type: "POST",
            url: "/index.php/ajax_common",
            data: "p_up_code_cn=" + p_curr_id + "&p_target_name=txt_id",
            success: function (msg) {
                var id_use_yn;
                //$("#dv_table_area").html('');
                //$("#dv_table_area").html(msg);
                console.log(msg);
                //alert(msg);
                if (msg==='1') {
                    alert('사용할 수 없는 아이디입니다. 다른 아이디를 사용하십시요.');
                     $("#txt_id").val('');
                     $("#txt_id").focus();
                } else {
                    id_use_yn =confirm('사용가능한 아이디입니다. 사용하시겠습니까?');
                    if(!id_use_yn){
                     $("#txt_id").val('');
                     $("#txt_id").focus();
                    }
                }
            },
            error: function (xhr, ajaxOptions, thrownError) {
                alert(thrownError);
            }
        });
    return false;        
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
    submitForm: function(){
            document.join_member.submit();
    },
/*
    layerOpen : function (){
            //var event = event || window.event,          //이벤트객체
            //el = (typeof event.target !=='undefined') ? event.target : event.srcElement;           //소스 앨리먼트
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
    */
     openZipSearch : function (){
    new daum.Postcode({
        oncomplete: function(data) {
            // 팝업에서 검색결과 항목을 클릭했을때 실행할 코드를 작성하는 부분입니다.
            // 예제를 참고하여 다양한 활용법을 확인해 보세요.
            $('#txt_zip_code').val(data.zonecode);
            $('#txt_address').val(data.address);
            //console.log(data.zonecode, data.address);
        }
    }).open();        
     }          
};
/*
*/
$(document).ready(function () { 
    //이벤트 핸들러 연결
    $('#btn_dupl_id').bind('click', objMemberJoinAjax.fnIdCheck);                                           //ID중복확인
    
    $('.tel').bind('keypress', fnCommons.inputOnlyNumber);                                                      //전화번호, 팩스 휴대폰 숫자만입력
    $('#dv_reg_no').bind('keypress', fnCommons.inputOnlyNumber);                                        //사업자등록번호 숫자만입력
    $('#cbo_email_domain').bind('change', objMemberJoinEvents.changeEmailDomain);       //이메일 도메인 선택 셀랙트 박스 
    //$('#btn_zipcode_search').bind('click', objMemberJoinEvents.layerOpen);                            //우편번호 레이어 팝업
    $('#btn_zipcode_search').bind('click', objMemberJoinEvents.openZipSearch);                       //daum우편번호 검색 팝업
    $('#btn_insert').bind('click', objMemberJoinEvents.submitForm);                                  //입력버튼클릭  
});