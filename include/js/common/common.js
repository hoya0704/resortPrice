var fnCommons ={}, 
	eventUtil = {};

eventUtil = {
	addHandler: function(element, type, handler){

	},
	removeHandler: function(element, type, handler) {

	},
	getEvent: function(event) {
		return event ? event : window.event;
	},
	getTarget: function(event) {
		return event.target || event.srcElement;
	},
	preventDefault: function(event) {
		if (event.preventDefault) {
			event.preventDefault();
		} else {
			event.returnValue = false;
		}
	},
	stopPropagation: function(event) {
		if (event.stopPropagation) {
			event.stopPropagation();
		} else {
			event.cancelBubble = true;
		}		
	},
	getRelatedTarget: function(event) {
		if (event.relatedTarget) {
			return event.relatedTarget;
		} else if (event.toElement) {
			return event.toElement;
		} else if (event.fromElement) {
			return event.fromElement;
		} else {
			return null;
		}
	},
	getButton: function(event) {
		if (document.implementation.hasFeature("MouseEvents", "2.0")) {
			return event.button;
		} else {
			switch(event.button) {
				case 0:
				case 1:
				case 3:
				case 5:
				case 7:
					return 0;
				case 2:
				case 6:
					return 2;
				case 4:
					return 1;
			}
		}
	},
	getCharCode: function(event) {
		if (typeof event.charCode ==="number") {
			return event.charCode;
		} else {
			return event.keyCode;
		}
	},
}

fnCommons ={
	inputOnlyNumber: function() {		//숫자만 입력
		var event = event || window.event, 			//이벤트객체
			eventTarget = (typeof event.target !=='undefined') ? event.target : event.srcElement, 			//소스 앨리먼트
			//$eventTargetID = $('#' + eventTarget.id),
			keyID = (event.which) ? event.which :event.keyCode;

			//console.log(eventTarget.id, $eventTargetID.val());

		if ((keyID >= 48 && keyID <=57) || keyID === 8 || keyID === 9 || keyID === 37  || keyID === 39  || keyID === 46 ) {
			/*
			if (eventTarget.id ==='txt_reg_no') {
				if ($eventTargetID.val().length ===3) {
					alert('사업자등록번호 첫 번째자리는 숫자 3자리까지 입력이 가능합니다.');
					$('#txt_reg_no2').focus();
				}
			} else if (eventTarget.id ==='txt_reg_no2'){
				if ($eventTargetID.val().length ===2) {
					alert('사업자등록번호 두 번째자리는 숫자 2자리까지 입력이 가능합니다.');
					$('#txt_reg_no3').focus();
				}
			} else {
				if ($eventTargetID.val().length ===5) {
					alert('사업자등록번호 세 번째자리는 숫자 5자리까지 입력이 가능합니다.');
				}
			}
			*/
			return true;
		} else {
			event.returnValue = false;
		}
	},
	checkTextboxNull : function (p_msg_name) {
			if (eventTarget.value ==='') {
				alert(p_text_name + '을(를) 입력하여 주십시요.');
				eventTarget.focus();
			}
	},        
    getChkedValues: function (p_checkbox_name){			//동일한 name의 체크박스 체크된 value값
          var chked_val = "";
          $(":checkbox[name='"+ p_checkbox_name +"']:checked").each(function(pi,po){
            chked_val += ","+po.value;
          });
          if(chked_val!="")chked_val = chked_val.substring(1);
          return chked_val;
        },


            /**
     * 두 날짜의 차이를 일자로 구한다.(조회 종료일 - 조회 시작일)
     *
     * @param val1 - 조회 시작일(날짜 ex.2002-01-01)
     * @param val2 - 조회 종료일(날짜 ex.2002-01-01)
     * @return 기간에 해당하는 일자
     */
     calDateRange : function(val1, val2){
        var FORMAT = "-";

        // FORMAT을 포함한 길이 체크
        if (val1.length != 10 || val2.length != 10)
            return null; 

        // FORMAT이 있는지 체크
        if (val1.indexOf(FORMAT) < 0 || val2.indexOf(FORMAT) < 0)
            return null;

        // 년도, 월, 일로 분리
        var start_dt = val1.split(FORMAT);
        var end_dt = val2.split(FORMAT); 

        // 월 - 1(자바스크립트는 월이 0부터 시작하기 때문에...)
        // Number()를 이용하여 08, 09월을 10진수로 인식하게 함.
        start_dt[1] = (Number(start_dt[1]) - 1) + "";
        end_dt[1] = (Number(end_dt[1]) - 1) + ""; 

        var from_dt = new Date(start_dt[0], start_dt[1], start_dt[2]);
        var to_dt = new Date(end_dt[0], end_dt[1], end_dt[2]);

        return (to_dt.getTime() - from_dt.getTime()) / 1000 / 60 / 60 / 24;
    }    

};