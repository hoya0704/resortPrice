  <div id="contents">	
	<div class="left_menu">
	<div class="left_menu">
		<?php require_once  INCLUDE_ROOT .'/mnuLeftAdminReservation.php';?> <!-- Left menu -->
	</div>
	</div>
	<div class="main">
		<div class="navi">
			<ul>
				<li><a href="#">HOME</a> > 예약하기</li>	
			</ul>
		</div>
		<div  class="bbs1">
			<ul>
				<li>
					<table class="tb_ty1">
						<colgroup>
							<col width="145">
							<col width="665">
						</colgroup>
						<tr>
							<th>업체명</th>
							<td><?php echo @$this ->session ->userdata['title']?></td>
						</tr>
						<tr>
							<th>담당자</th>
							<td><?php echo @$this ->session ->userdata['major_name']?></td>
						</tr>
						<tr>
							<th>국가/지역</th>
							<td>
								<select name="cbo_nation" id="cbo_nation">
									<option value="0">국가선택</option>
	<?php
	foreach ($nation as $nl)
	{
	?>					
									<option value="<?php echo $nl -> code_cn;?>"><?php echo $nl -> code_name;?></option>
	<?php
	}
	?>
								</select> 								
							<select name="cbo_area" id="cbo_area"><option value="0">지역선택</option></select> 
							</td>
						</tr>					
						<tr>
							<th>리조트/객실타입</th>
							<td>							<select name="cbo_resort" id="cbo_resort"><option value="0">리조트선택</option></select> 
 <select style="width:200px" name="cbo_room" id="cbo_room"><option>객실타입선택</option></select></td>
						</tr>
						<tr>
							<th>식사/객실수</th>
							<td><select style="width:200px" name="cbo_meal" id="cbo_meal"><option>식사타입선택</option></select> <select style="width:100px"><option>1</option></select></td>
						</tr>
						<tr>
							<th>체크인</th>
							<td><input type="text" id="datepicker1" readonly> <input type="text" placeholder="항공 또는 선투숙호텔"> <input type="text" placeholder="운송수단 출/도착시간"></td>
						</tr>
						<tr>
							<th>체크아웃</th>
							<td><input type="text" id="datepicker2" readonly> <input type="text" placeholder="항공 또는 선투숙호텔"> <input type="text" placeholder="운송수단 출/도착시간"></td>
						</tr>
						<tr>
							<th>숙박일</th>
							<td>
								<!--<select style="width:100px"><option></option></select> 박 (선택 시 체크아웃날짜가 자동으로 계산됩니다.)-->
								<p>
								  <input id="spinner" name="value">박 (선택 시 체크아웃날짜가 자동으로 계산됩니다.)
								</p>
							</td>
						</tr>
						<tr>
							<th rowspan="3">주소</th>
							<td>영문이름 입력시 이름/성으로 넣어주세요! EX) 고소영 - SOYOUNG/GO</td>
						</tr>
						<tr>							
							<td><select style="width:70px"><option>MR</option></select> 국문 <input type="text"> 국문 <input type="text"></td>
						</tr>
						<tr>							
							<td><select style="width:70px"><option>MR</option></select> 국문 <input type="text"> 국문 <input type="text"></td>
						</tr>
						<tr>
							<th>예약 담당자</th>
							<td><input  type="text"></td>
						</tr>
						<tr>
							<th>비고</th>
							<td style="padding:10px"><textarea style="width:625px;height:190px;padding:10px" placeholder="식사/트랜스퍼/스파등의 추가사항이나, 유아나 아동의 생년월일을 기입"></textarea></td>
						</tr>
					</table>
					
				</li>
				
				<li class="btn"><img src="<?php echo IMG_DIR?>/btn5.jpg" alt="예약요청"></li>
			</ul>
		</div>
	</div>
  </div>
    <!-- javascript 영역 -->
  <script src="<?php echo JS_ROOT?>/reservationWrite.js"></script> 
  <script src="<?php echo JS_ROOT?>/common/calendar.js"></script>
  <script src="<?php echo JS_ROOT?>/common/common.js"></script>    
  <!-- javascript 영역 끝-->

  </div>
 </body>
</html>
