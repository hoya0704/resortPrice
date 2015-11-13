  <div id="contents">	
	<div class="left_menu">
		<?php   
if ($this ->session ->userdata['auth_code'] == '1')
{
		INCLUDE_ROOT .'/mnuLeftAdminMem.php';
}
?> <!-- Left menu -->  
	</div>
	<div class="main">
		<div class="navi">
			<ul>
				<li><a href="#">HOME</a> > 회원가입</li>	
			</ul>
		</div>
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
							<td colspan="3"><input type="text" style="width:625px" name="txt_title" id="txt_title"></td>
						</tr>
						<tr>
							<th>대표자명</th>
							<td colspan="3"><input type="text" style="width:135px" name="txt_president_name" id="txt_president_name"></td>
						</tr>
						<tr>
							<th>아이디</th>
							<td colspan="3"><input type="text" style="width:135px" name="txt_id"  id="txt_id" >
								<!--<button name="btn_dupl_id" id="btn_dupl_id"></button>-->
									<a href="#"><img src="<?php echo IMG_DIR?>/overlap.jpg" alt="중복확인"></a></td>
						</tr>
						<tr>
							<th>비밀번호</th>
							<td><input type="password" style="width:135px" name="txt_pw"  id="txt_pw"></td>
							<th>비밀번호확인</th>
							<td><input type="password" style="width:135px" name="txt_pw_confirm"  id="txt_pw_confirm" ></td>
						</tr>
						<tr>
							<th>사업자등록번호</th>
							<td colspan="3">
								<!--<input type="text" style="width:625px">-->
								<div id="dv_reg_no">
									<input type="text" name="txt_reg_no"  id="txt_reg_no" class="regi_input2" maxlength ="3" /> -
									<input type="text" name="txt_reg_no2" id="txt_reg_no2" class="regi_input2" maxlength ="2"/> -
									<input type="text" name="txt_reg_no3"  id="txt_reg_no3" class="regi_input2" maxlength ="5"/>
								</div>			
							</td>
						</tr>
						<tr>
							<th>업태</th>
							<td><input type="text" style="width:135px"  name="txt_biz_type"  id="txt_biz_type"></td>
							<th>종목</th>
							<td><input type="text" style="width:135px" name="txt_biz_item"  id="txt_biz_item" ></td>
						</tr>
						<tr>
							<th rowspan="2">주소</th>
							<td colspan="3" class="type2"><input type="text" style="width:40px"  name="txt_zip_code"  id="txt_zip_code" class="tel" maxlength ="3"> - <input type="text"  name="txt_zip_code2"  id="txt_zip_code2" class="tel" maxlength ="3"> <img src="<?php echo IMG_DIR?>/post.jpg" alt="우편번호"></td>
						</tr>
						<tr>							
							<td colspan="3" class="type2"><input type="text" style="width:300px"  name="txt_address"  id="txt_address" > <input type="text" style="width:230px" name="txt_addr_detail" id="txt_addr_detail"></td>
						</tr>
						<tr>
							<th>전화번호</th>
							<td colspan="3"><input type="text" name="txt_tel"  id="txt_tel" class="tel" />-<input type="text" name="txt_tel2" id="txt_tel2" class="tel" />-<input type="text"name="txt_tel3" id="txt_tel3" class="tel" /></td>
						</tr>
						<tr>
							<th>팩스번호</th>
							<td colspan="3"><input type="text" name="txt_fax" id="txt_fax" class="tel" />-<input type="text" name="txt_fax2" id="txt_fax2" class="tel" />-<input type="text" name="txt_fax3" id="txt_fax3" class="tel" /></td>
						</tr>
						<tr>
							<th>담당자</th>
							<td colspan="3"><input type="text" style="width:135px"  name="txt_major_name"  id="txt_major_name" ></td>
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
					-<input type="text" name="txt_major_mobile2" id="txt_major_mobile2" class="tel" />-<input type="text" name="txt_major_mobile3" id="txt_major_mobile3" class="tel" /></td>
						</tr>
						<tr>
							<th>이메일</th>
							<td colspan="3"><input type="text" name="txt_email_id"  id="txt_email_id" class="regi_input2" />@<input type="text" name="txt_email_domain" id="txt_email_domain" class="regi_input2" />
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
							<td colspan="3">http://<input type="text" style="width:250px"></td>
						</tr>
						
					</table>
					
				</li>
				
				<li class="btn"><img src="<?php echo IMG_DIR?>/btn2.jpg" alt="정보수정"> <img src="<?php echo IMG_DIR?>/btn3.jpg" alt="저장하기"> <img src="<?php echo IMG_DIR?>/btn4.jpg" alt="취소하기"></li>
			</ul>
		</div>
	</div>
  </div>
    <!-- javascript 영역 -->
  <script src="<?php echo JS_ROOT?>/memberView.js"></script> 
  <script src="<?php echo JS_ROOT?>/common/common.js"></script>    
  <!-- javascript 영역 끝-->  
