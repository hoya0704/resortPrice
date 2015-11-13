 <div id="contents">	
	<div class="left_menu">
		<?php require_once  INCLUDE_ROOT .'/mnuLeftAdminMem.php';?> <!-- Left menu -->
	</div>
	<div class="main">
		<div class="navi">
			<ul>
				<li><a href="#">HOME</a> >회원관리</li>	
			</ul>
		</div>
		<div class="serch">
			<ul>
				<li>검색키워드<select>
												<option value="I">아이디</option>
												<option value="T">상호</option>
												<option value="A">아이디+상호</option>
											</select> 
											<input type="txt_search_keyword" id="txt_search_keyword" name="txt_search_keyword">  가입일 : <input type="text" id="datepicker1" readonly> ~ <input type="text" id="datepicker2" readonly>
					<button id="btn_serach" name="btn_serach"><img src="<?php echo IMG_DIR?>/serch_btn.jpg"></button> <!--<img src="../images/serch_btn.jpg" name="btn_area" id="btn_area">-->
				</li>
			</ul>
		</div>
		<div  class="bbs1">
			<ul>
				<li>
					<table class="tb_ty1" name="tb_member_list" id="tb_member_list">
						<colgroup>
							<col width="40">
							<col width="90">
							<col width="90">
							<col width="200">
							<col width="150">
							<col width="90">
							<!--<col width="90">-->
							<col width="90">
							<col width="120">
							<!--<col width="90">-->
							<col width="90">							
						</colgroup>
						<thead>
							<tr>
								<th class="type3">번호</th>
								<th class="type3">아이디</th>
								<th class="type3">가입일</th>
								<th class="type3">상호</th>	
								<th class="type3">사업자등록번호</th>
								<th class="type3">전화번호</th>
								<!--<th class="type3">팩스번호</th>-->
								<th class="type3">담당자</th>
								<th class="type3">휴대폰</th>	
								<!--<th class="type3">이메일</th>-->
								<th class="type3">승인</th>															
							</tr>		
						</thead>											
					<tbody>
	<?php
	foreach ($list as $lt)
	{
?>					<tr>
						<th scope="row">
							<?php echo $lt->no;?>
						</th>
						<td><a class="hyper_title" rel="external" href="<?php echo LOCAL_PATH?>/index.php/<?php echo $this->uri->segment(1);?>/view/<?php echo $lt->id;?>"><?php echo $lt->id;?></a></td>
						<td><?php echo $lt->join_date;?></td>
						<td><a class="hyper_title" rel="external" href="<?php echo LOCAL_PATH?>/index.php/<?php echo $this->uri->segment(1);?>/view/<?php echo $lt->id;?>"><?php echo $lt->title;?></a></td>
						<td><a class="hyper_title" rel="external" href="<?php echo LOCAL_PATH?>/index.php/<?php echo $this->uri->segment(1);?>/view/<?php echo $lt->id;?>"><?php echo $lt->reg_no;?></a></td>
						<td><?php echo $lt->tel;?></td>
						<!--<td><?php echo $lt->fax;?></td>-->
						<td><?php echo $lt->major_name;?></td>
						<td><?php echo $lt->mobile;?></td>
						<!--<td><?php echo $lt->email;?></td>-->
						<td><?php echo $lt->active;?></td>
					</tr>
	<?php
	}
	?>
					</tbody>
					<tfoot>
						<tr>
							<th style="text-align: center;" colspan="11"<?php echo $pagination;?>></th>
						</tr>
					</tfoot>				
				</table>								
				</li>				
			</ul>
		</div>
  </div>
  <!-- javascript 영역 -->
  <script src="<?php echo JS_ROOT?>/common/calendar.js"></script>
  <script src="<?php echo JS_ROOT?>/common/common.js"></script>
  <script src="<?php echo JS_ROOT?>/memberList.js"></script> 
  <!-- javascript 영역 끝-->    
