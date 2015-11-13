  <div id="contents">	
	<div class="left_menu">
		<?php require_once  INCLUDE_ROOT .'/mnuLeftAdminMem.php';?> <!-- Left menu -->
	</div>
	<div class="main">
		<div class="navi">
			<ul>
				<li><a href="#">HOME</a> > 회원가입</li>	
			</ul>
		</div>
		<form name="edit_member" id="edit_member" method="post" action="">			
		<div  class="bbs1">
			<ul>
				<li>
					<table class="tb_ty1">
						<colgroup>
							<col width="145">
							<col width="210">
							<col width="145">
							<col width="210">
						</colgroup>
						<tr>
							<th>상호</th>
							<td colspan="3"><input type="text" style="width:625px" name="txt_title" id="txt_title" value="<?php echo $views -> title?>"></td>
						</tr>
						<tr>
							<th>대표자명</th>
							<td colspan="3"><input type="text" style="width:135px" name="txt_president_name" id="txt_president_name" value="<?php echo $views -> president_name?>"></td>
						</tr>
						<tr>
							<th>아이디</th>
							<td colspan="3" id ="td_id"><?php echo $views -> id?>
						</tr>
						<tr>
							<th>비밀번호</th>
							<td ><?php //echo $views -> pw?>********<!--<input type="password" style="width:135px" name="txt_pw"  id="txt_pw">--></td>
							<th>비밀번호변경</th>
							<td><img name="btn_layer_pop" id="btn_layer_pop" src="<?php echo IMG_DIR?>/bt_pwchange.gif" alt="비밀번호변경"></td>
						</tr>
						<tr>
							<th>사업자등록번호</th>
							<td colspan="3">
								<!--<input type="text" style="width:625px">-->
								<div id="dv_reg_no">
									<input type="text" name="txt_reg_no"  id="txt_reg_no" class="regi_input2" maxlength ="3" value="<?php echo $views -> reg_no?>" /> -
									<input type="text" name="txt_reg_no2" id="txt_reg_no2" class="regi_input2" maxlength ="2" value="<?php echo $views -> reg_no2?>"/> -
									<input type="text" name="txt_reg_no3"  id="txt_reg_no3" class="regi_input2" maxlength ="5" value="<?php echo $views -> reg_no3?>"/>
								</div>			
							</td>
						</tr>
						<tr>
							<th>업태</th>
							<td><input type="text" style="width:135px"  name="txt_biz_type"  id="txt_biz_type" value="<?php echo $views -> biz_type?>"></td>
							<th>종목</th>
							<td><input type="text" style="width:135px" name="txt_biz_item"  id="txt_biz_item" value="<?php echo $views -> biz_item?>"></td>
						</tr>
						<tr>
							<th rowspan="2">주소</th>
							<td colspan="3" class="type2"><input type="text" style="width:40px"  name="txt_zip_code"  id="txt_zip_code" class="tel" maxlength ="3" value="<?php echo $views -> zip_code ?>">
							<!--  - <input type="text"  name="txt_zip_code2"  id="txt_zip_code2" class="tel" maxlength ="3" value="<?php echo $views -> zip_code2?>">-->
							<img src="<?php echo IMG_DIR?>/post.jpg" alt="우편번호">
							</td>
						</tr>
						<tr>							
							<td colspan="3" class="type2"><input type="text" style="width:300px"  name="txt_address"  id="txt_address" value="<?php echo $views -> address?>">
							 <input type="text" style="width:230px" name="txt_addr_detail" id="txt_addr_detail" value="<?php echo $views -> addr_detail?>">
							 </td>
						</tr>
						<tr>
							<th>전화번호</th>
							<td colspan="3"><input type="text" name="txt_tel"  id="txt_tel" class="tel" value="<?php echo $views -> tel?>"/>
								-<input type="text" name="txt_tel2" id="txt_tel2" class="tel" value="<?php echo $views -> tel2?>"/>
								-<input type="text" name="txt_tel3" id="txt_tel3" class="tel" value="<?php echo $views -> tel3?>"/></td>
						</tr>
						<tr>
							<th>팩스번호</th>
							<td colspan="3"><input type="text" name="txt_fax" id="txt_fax" class="tel" value="<?php echo $views -> fax?>"/>
								-<input type="text" name="txt_fax2" id="txt_fax2" class="tel" value="<?php echo $views -> fax2?>"/>
								-<input type="text" name="txt_fax3" id="txt_fax3" class="tel" value="<?php echo $views -> fax3?>"/></td>
						</tr>
						<tr>
							<th>담당자</th>
							<td colspan="3"><input type="text" style="width:135px"  name="txt_major_name"  id="txt_major_name" value="<?php echo $views -> major_name?>"></td>
						</tr>
						<tr>
							<th>휴대폰</th>
							<td colspan="3">
								<select name="cbo_major_mobile" id="cbo_major_mobile" class="zone_select">
								<option value="0">-선 택-</option>
	<?php
	foreach ($mobile as $ml)
	{
	?>					
									<option value="<?php echo $ml -> code_cn;?>"><?php echo $ml -> code_name;?></option>
	<?php
	}
	?>												
							</select>
					-<input type="text" name="txt_major_mobile2" id="txt_major_mobile2" class="tel" value="<?php echo $views -> major_mobile2?>"/>
					-<input type="text" name="txt_major_mobile3" id="txt_major_mobile3" class="tel" value="<?php echo $views -> major_mobile3?>"/></td>
						</tr>
						<tr>
							<th>이메일</th>
							<td colspan="3"><input type="text" class="regi_input2" name="txt_email_id"  id="txt_email_id" class="regi_input2" value="<?php echo $views -> email_id?>"/>
								@<input type="text" name="txt_email_domain" id="txt_email_domain" class="regi_input2" value="<?php echo $views -> email_domain?>"/>
								<select name="cbo_email_domain" id="cbo_email_domain" class="zone_select">
									<option value="0">직접 입력</option>
	<?php
	foreach ($email_domain as $el)
	{
	?>					
									<option value="<?php echo $el -> code_cn;?>"><?php echo $el -> code_name;?></option>
	<?php
	}
	?>									
								</select>
							</td>
						</tr>
						<tr>
							<th>회사로고</th>
							<td colspan="3"><input type="file"> (사이즈 : 165x40 pixel)</td>
						</tr>
						<tr>
							<th>홈페이지</th>
							<td colspan="3">http://<input type="text" style="width:250px" name="txt_homepage" id ="txt_homepage" value="<?php echo $views -> homepage?>"></td>
						</tr>
					</table>
				</li>
				<li class="btn">
<?php 
		if ($this ->session ->userdata['auth_code'] == '0')
		{
?>
				 	<img name="btn_deny" id="btn_deny" src="<?php echo IMG_DIR?>/bt_stopid.gif" alt="계정중지">
				 	<img name="btn_permit" id="btn_permit" src="<?php echo IMG_DIR?>/bt_joinok.gif" alt="가입승인">
<?php
		}
?>
					<img name="btn_update" id="btn_update" src="<?php echo IMG_DIR?>/btn2.jpg" alt="정보수정">
				 	<a href="<?php echo LOCAL_PATH?>/index.php/member"><img src="<?php echo IMG_DIR?>/btn4.jpg" alt="취소하기"></a>
				</li>
			</ul>
		</div>
		</form>

<!--비밀번호변경 레이어팝업 -->
	<form name="edit_pw" id="edit_pw" method="post" action="">			
		<div id="layer1" class="pop-layer">
			<div class="pop-container">
			<div class="pop-conts">
				<!--content //-->
				<div class="btn-r">
					<table class="tb_ty1">
						<colgroup>
							<col width="80">
							<col width="100">
							<col width="100">
							<col width="100">
						</colgroup>
						<tr>
							<th>이전비밀번호</th>
							<td ><input type="password" name="txt_old_pw" id="txt_old_pw" value=""></td>
						</tr>							
						<tr>
							<th>새비밀번호 </th>
							<td><input type="password"  name="txt_new_pw" id="txt_new_pw" value=""></td>
							<th>새비밀번호확인 </th>
							<td><input type="password"  name="txt_new_pw_confirm" id="txt_new_pw_confirm" value=""></td>
						</tr>
					</table>
					<br/>
					<li>
						<a class="cbtn2" name="btn_change_pw" id="btn_change_pw"  href="#">비밀번호변경</a>
						<a href="#" class="cbtn">닫기</a>
					</li>
				</div>
			</div>
 		</div>
	</form>
	<!--비밀번호변경 레이어팝업 종료 -->
    <!-- javascript 영역 -->
  <script src="<?php echo JS_ROOT?>/common/common.js"></script>    
  <script src="<?php echo JS_ROOT?>/memberView.js"></script> 
  <!-- javascript 영역 끝-->  
