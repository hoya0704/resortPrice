<div id="contents">	
	<div class="left_menu">
		<?php require_once  INCLUDE_ROOT .'/mnuLeftAdminResort.php';?> <!-- Left menu -->
	</div>
	<div class="main">
		<div class="navi">
			<ul>
				<li><a href="#">HOME</a> > 리조트목록</li>	
			</ul>
		</div>
		<div class="serch">
			<ul>
				<li><select><option>선택</option></select> <select><option>제목+내용</option></select> <input type="" name="txt_search_keyword" id="txt_search_keyword"> <button id="btn_serach">검색<!--<img src="../images/serch_btn.jpg" name="btn_area" id="btn_area">--></button></li>
			</ul>
		</div>
		<div  class="bbs1">
			<ul>
				<li>
					<!--<div id="dv_resort_list"></div>-->
					<table class="tb_ty1">
						<colgroup>
							<col width="30">
							<col width="80">
							<col width="100">
							<col width="240">
							<col width="90">
							<col width="120">
						</colgroup>
						<thead>
							<tr>
								<th class="type3">번호</th>
								<th class="type3">국가</th>
								<th class="type3">지역명</th>
								<th class="type3">리조트(영문)</th>	
								<th class="type3">등급</th>
								<th class="type3">등록일</th>					
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
						<td><?php echo $lt->nation;?></td>
						<td><?php echo $lt->area;?></td>
						<td><a class="data_link" rel="external" href="<?php echo LOCAL_PATH?>/index.php/<?php echo $this->uri->segment(1);?>/view/<?php echo $lt->resort_cn;?>"><?php echo $lt->title_us;?></a></td>
						<td><?php echo $lt->grade;?></td>
						<td><?php echo $lt->create_date;?></td>
					</tr>
<?php
}
?>
				</tbody>
				<tfoot>
					<tr>
						<th style="text-align: center;" colspan="6"<?php echo $pagination;?>></th>
					</tr>
				</tfoot>				
			</table>



			</li>
			</ul>
		</div>
<!--		
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
  <!-- javascript 영역 -->
  <script src="<?php echo JS_ROOT?>/resortList.js"></script> 
  <script src="<?php echo JS_ROOT?>/common/calendar.js"></script>
  <script src="<?php echo JS_ROOT?>/common/common.js"></script>
  <!-- javascript 영역 끝-->  
  </div>
 </body>
</html>
