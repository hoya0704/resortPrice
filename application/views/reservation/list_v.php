  <div id="contents">	
	<div class="left_menu">
		<?php require_once  INCLUDE_ROOT .'/mnuLeftAdminReservation.php';?> <!-- Left menu -->
	</div>
	<div class="main">
		<div class="navi">
			<ul>
				<li><a href="#">HOME</a> > 예약목록</li>
			</ul>
		</div>

		<div class="serch">	<!-- 검색영역 -->
			<form id="frm_search" method="post">
				<ul>
					<li><select name="cbo_nation" id="cbo_nation">
								<option value="0">국가선택</option>
	<?php
	foreach ($nation as $nt)
	{
	?>					
								<option value="<?php echo $nt -> code_cn;?>"><?php echo $nt -> code_name;?></option>
	<?php
	}
	?>
							</select> 
							<select name="cbo_area" id="cbo_area"><option value="0">지역선택</option></select> 
							<select name="cbo_resort" id="cbo_resort"><option value="0">리조트선택</option></select> 
							<select><option value="0">정렬기준선택</option></select> 
							<select><option value="0">예약상황선택</option></select> 
					</li>
					<li><select><option value="0">선택</option></select> <input type="text" name="txt_keyword" id="txt_keyword"> <input type="text" id="datepicker1" readonly>  ~ <input type="text" id="datepicker2" readonly> 
						<button name="btn_search" id="btn_search"><img src="<?php echo IMG_DIR?>/serch_btn.jpg" alt="검색"></button> 
							<img src="<?php echo IMG_DIR?>/reset.jpg" alt="리셋"> <!--<img src="<?php echo IMG_DIR?>/excel.jpg" alt="엑셀">--> 
					</li>
				</ul>
			</form>			
		</div>	<!-- 검색영역 끝-->
		<div  class="bbs1">
			<table class="tb_ty1" cellspaCodeIgniterng="0" cellpadding="0">
					<colgroup>
						<col width="55">
						<col width="75">
						<col width="75">
						<col width="75">
						<col width="270">
						<col width="75">
						<col width="75">
						<col width="75">
						<col width="75">
					</colgroup>					
				<thead>
					<tr>
						<th class="type3">번호</th>
						<th class="type3">등록일</th>
						<th class="type3">체크인</th>
						<th class="type3">체크아웃</th>	
						<th class="type3">리조트</th>	
						<th class="type3">고객1</th>
						<th class="type3">고객2</th>
						<th class="type3">예약상황</th>
						<th class="type3">입금여부</th>
					</tr>
				</thead>
				<tbody>
<?php
foreach ($list as $lt)
{
?>					<tr>
						<th scope="row">
							<?php echo $lt->reservation_cn;?>
						</th>
						<td><?php echo $lt->reg_date;?></td>
						<td><?php echo $lt->checkin_date;?></td>
						<td><?php echo $lt->checkout_date;?></td>
						<td><a rel="external" href="<?php echo LOCAL_PATH?>/index.php/<?php echo $this->uri->segment(1);?>/view/<?php echo $lt->reservation_cn;?>"><?php echo $lt->resort;?></a></td>
						<td><?php echo $lt->client1;?></td>
						<td><?php echo $lt->client2;?></td>
						<td><?php
									switch ($lt->status) {
									 	case '0':
									 		echo '예약요청';
									 		break;
									 	case '1':
									 		echo '예약접수';
									 		break;
									 	case '2':
									 		echo '<img src='.IMG_DIR .'/c_btn3.jpg alt="입금완료">';
									 		break;
									 	case '3':
									 		echo '<img src='.IMG_DIR .'/c_btn1.jpg alt="예약완료">';
									 		break;
									 	default:
									 		'미확인';
									 		break;
									 } 
								;?>
						</td>
						<td><?php echo ($lt->status == '0' OR $lt->status == '1')?'<img src='.IMG_DIR .'/c_btn2.jpg alt="미입금">' : '<img src='.IMG_DIR .'/c_btn4.jpg alt="취소">' ;?></td>
					</tr>
<?php
}
?>
				</tbody>
				<tfoot>
					<tr>
						<th style="text-align: center;" colspan="9"<?php echo $pagination;?>></th>
					</tr>
				</tfoot>
			</table>			
			<!--
			<ul>
				<li>
					<table class="tb_ty1">
						<colgroup>
							<col width="55">
							<col width="75">
							<col width="75">
							<col width="75">
							<col width="270">
							<col width="75">
							<col width="75">
							<col width="75">
							<col width="75">
						</colgroup>
						<tr>
							<th class="type3">번호</th>
							<th class="type3">등록일</th>
							<th class="type3">체크인</th>
							<th class="type3">체크아웃</th>	
							<th class="type3">리조트</th>	
							<th class="type3">고객1</th>
							<th class="type3">고객2</th>
							<th class="type3">예약상황</th>
							<th class="type3">입금여부</th>
						</tr>					
						<tr>
							<td class="type3">1</td>
							<td class="type4">2015.06.18</td>
							<td class="type3">2015.07.29</td>
							<td class="type3">2015.07.29</td>			
							<td class="type3">몰디브|국내선|Jumeirah<br>Dhevanafushi Maldives</td>	
							<td class="type3">이승훈</td>	
							<td class="type3">김현아</td>	
							<td class="type3"><img src="<?php //echo IMG_DIR?>/c_btn1.jpg" alt="예약완료"></td>
							<td class="type3"><img src="<?php //echo IMG_DIR?>/c_btn2.jpg" alt="미입금"></td>
						</tr>
						<tr>
							<td class="type3">1</td>
							<td class="type4">2015.06.18</td>
							<td class="type3">2015.07.29</td>
							<td class="type3">2015.07.29</td>			
							<td class="type3">몰디브|국내선|Jumeirah<br>Dhevanafushi Maldives</td>	
							<td class="type3">이승훈</td>	
							<td class="type3">김현아</td>	
							<td class="type3"><img src="<?php //echo IMG_DIR?>/c_btn3.jpg" alt="입금완료"></td>
							<td class="type3"><img src="<?php //echo IMG_DIR?>/c_btn4.jpg" alt="취소"></td>
						</tr>
				</table>
			</ul>

		<div class="paging">
			<ul>
				<li class="over">1</li>
				<li class="off">2</li>
				<li class="off">3</li>
				<li class="off">4</li>
				<li class="off">5</li>
			</ul>
		</div>			
		-->	
		</div>

	</div>
  </div>
  <!-- javascript 영역 -->
  <script src="<?php echo JS_ROOT?>/reservationList.js"></script> 
  <script src="<?php echo JS_ROOT?>/common/calendar.js"></script>
  <script src="<?php echo JS_ROOT?>/common/common.js"></script>
  <!-- javascript 영역 끝-->

  </div>
 </body>
</html>
