<div id="contents">
	<div class="left_menu">
		<?php require_once  INCLUDE_ROOT .'/mnuLeftAdminResort.php';?> <!-- Left menu -->
	</div>
	<div class="main">
		<div class="navi">
			<ul>
				<li><a href="#">HOME</a> > 리조트등록</li>	
			</ul>
		</div>
		<form name="frm_resort" id="frm_resort" method="post">
			<div  class="bbs1">
			<ul>
				<li>
					<table class="tb_ty1">
						<colgroup>
							<col width="145">
							<col width="675">
						</colgroup>
						<tr>
							<th>국가(지명)/지역</th>
							<td>
<?php echo $views -> nation." / " .$views -> area?>
						</td>
						</tr>
						<tr>
							<th>등급</th>
							<td>
								<select style="width:150px"name="cbo_room_grade" id="cbo_room_grade">
									<option value="0">-등급선택-</option>
	<?php 		//등급
	foreach ($grade as $gl)
	{
		if ($views -> grade_code_cn == $gl -> code_cn)
		{
	?>
									<option value="<?php echo $gl -> code_cn;?>"  selected ><?php echo $gl -> code_name;?></option>
	<?php
		}
	?>					
									<option value="<?php echo $gl -> code_cn;?>" ><?php echo $gl -> code_name;?></option>
	<?php
	}
	?>								
								</select>					
							</td>
						</tr>
						<tr>
							<th >리조트명(한글)</th>
							<td>
<?php echo $views -> title_kr ?>								
								<!--
								<input type="text" style="width:450px" name="txt_title_kr" id="txt_title_kr" value="">
								-->
								</td>
						</tr>
						<tr>
							<th>리조트명(영문)</th>
							<td>
<?php echo $views -> title_us?>								
								<!--
								<input type="text" style="width:450px" name="txt_title_us" id="txt_title_us" value="">
							-->
						</td>
						</tr>
						<tr>
							<th>주소</th>
							<td><input type="text" style="width:450px" name="txt_address" id="txt_address" value="<?php echo $views -> address?>"></td>
						</tr>
						<tr>
							<th>전화번호</th>
							<td><input type="text" style="width:450px" name="txt_tel" id="txt_tel" value="<?php echo $views -> tel?>"></td>
						</tr>
						<tr>
							<th>팩스번호</th>
							<td><input type="text" style="width:450px" name="txt_fax" id="txt_fax" value="<?php echo $views -> fax?>"></td>
						</tr>
						<tr>
							<th>객실타입</th>
							<td>
								<div name="dv_room_checks" id="dv_room_checks">
	<?php 		//객실타입
	foreach ($room as $rl)
	{
	?>							
									<label><input type="checkbox" name="chk_room" id="chk_room_<?php echo $rl -> code_cn;?>" value="<?php echo $rl -> code_cn;?>" /><?php echo $rl -> code_name;?>&nbsp</label>
	<?php
	}
	?>									
								</div>							
							</td>
						</tr>
						<tr>
							<th>식사타입</th>
							<td>
								<div name="dv_meal_checks" id="dv_meal_checks">
	<?php 		//식사타입
	foreach ($meal as $ml)
	{
	?>							
									<label><input type="checkbox" name="chk_meal" id="chk_meal_<?php echo $ml -> code_cn;?>" value="<?php echo $ml -> code_cn;?>" /><?php echo $ml -> code_name;?>&nbsp</label>
	<?php
	}
	?>	
								<div>
							
							</td>
						</tr>
						<tr>
							<th>이동수단</th>
							<td>
								<div name="dv_vehicle_checks" id="dv_vehicle_checks">
	<?php 		//이동수단
	foreach ($vehicle as $vl)
	{
	?>							
								<label><input type="checkbox" name="chk_vehicle" id="chk_vehicle_<?php echo $vl -> code_cn;?>" value="<?php echo $vl -> code_cn;?>" /><?php echo $vl -> code_name;?>&nbsp</label>
	<?php
	}
	?>
								<div>									
							</td>
						</tr>
						<tr>
							<th>리조트특징</th>
							<td><textarea style="width:535px;height:120px;margin:3px 0;" name="txt_special" id="txt_special"><?php echo $views -> special?></textarea></td>
						</tr>
						<tr>
							<th>허니문 특전</th>
							<td><textarea style="width:535px;height:120px;margin:3px 0" name="txt_honeymoon_privilege" id="txt_honeymoon_privilege"><?php echo $views -> honeymoon_privilege?></textarea></td>
						</tr>
						<tr>
							<th>포함사항</th>
							<td><textarea style="width:535px;height:120px;margin:3px 0" name="txt_inclusion" id="txt_inclusion"><?php echo $views -> inclusion?></textarea></td>
						</tr>
						<tr>
							<th>불포함사항</th>
							<td><textarea style="width:535px;height:120px;margin:3px 0" name="txt_exclusion" id="txt_exclusion"><?php echo $views -> exclusion?></textarea></td>
						</tr>
						<tr>
							<th>활성</th>
							<td><input type="checkbox" name="chk_active" id="chk_active" <?php echo ($views -> active =="Y")?"checked":"unchecked"?>></td>
						</tr>						
						</table>						
				<!--<li class="btn"><div name="btn_area" id="btn_area"><a href="#" name="btn_del" id="btn_del"><img src="../images/btn6.jpg" alt="정보삭제"></a> <a href="#" name="btn_update" id="btn_update"><img src="../images/btn2.jpg" alt="정보수정"></a> <a href="#" name="btn_insert" id="btn_insert"><img src="../images/btn7.jpg" alt="리조트등록"></a></div></li>-->
				<li class="btn">
					<div name="btn_area" id="btn_area">
						 <!--<img name="btn_del" id="btn_del" src="<?php echo IMG_DIR?>/btn6.jpg" alt="정보삭제">-->
						 <img  name="btn_update" id="btn_update" src="<?php echo IMG_DIR?>/btn2.jpg" alt="정보수정">
						 <!--<img name="btn_insert" id="btn_insert" src="<?php echo IMG_DIR?>/btn7.jpg" alt="리조트등록">-->
					</div>
				</li>
			</ul>
			<div id="dv_hdn_area">
				<input type="hidden" name="hdn_room_code_cns" id="hdn_room_code_cns" value="<?php echo $views -> room_code_cns?>"><!-- 객실타입 체크박스 cn값들-->
				<input type="hidden" name="hdn_meal_code_cns" id="hdn_meal_code_cns" value="<?php echo $views -> meal_code_cns?>"><!-- 식사타입 체크박스 cn값들-->
				<input type="hidden" name="hdn_vehicle_code_cns" id="hdn_vehicle_code_cns" value="<?php echo $views -> vehicle_code_cns?>"><!-- 식사타입 체크박스 cn값들-->

			</div>
		</form>			 
		</div>
	</div>
  </div>
  <!-- javascript 영역 -->
  <script src="<?php echo JS_ROOT?>/common/common.js"></script>
  <script src="<?php echo JS_ROOT?>/resortView.js"></script> 
  <!-- javascript 영역 끝-->  
  </div>
 </body>
</html>
