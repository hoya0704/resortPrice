
  <script>
  	var clickSearchButton = function() {
		var base_url ='<?php echo LOCAL_PATH?>/index.php/board/lists/BOARD/',
				act = '';

			if($('#txt_keyword').val()==''){		//검색어 텍스트박스
	    		//alert('검색어를 입력하세요.');
	    		//return false;
	    	 	act = base_url;
    		} else {
	    	   act = base_url + 'txt_keyword/' + $("#txt_keyword").val() +'/';
	    	}

			if($('#cbo_b_type').val()==''){		//게시판종류 셀랙트박스
	    		//alert('검색어를 입력하세요.');
	    		//return false;
	    	 	act = act;
    		} else {
	    	   act += 'b_type/' + $("#cbo_b_type").val();		//게시판 종류 공통코드값
	    	}

	    	act +=  '/page/1';		//페이지 정보는 제일 마지막에 위치

	    	$("#frm_search").attr('action', act).submit();
	 };	

	 var clickInsertButton = function () {	
	 	var b_type = $('#cbo_b_type').val();
// console.log(b_type);
		if (b_type === '546') {		//공지사항
	 		window.location = 'http://resortprice.co.kr/index.php/board/write_notice';
		} else if (b_type === '547') {		//자료실
	 		window.location = 'http://resortprice.co.kr/index.php/board/write_room';
		} else {
			alert('게시판 종류를 선택하여 주십시요.');
			$('#cbo_b_type').focus();
		}
	 };

	$(document).ready(function () {
	var b_type = '<?php echo $board_type ?>';
	// console.log(b_type);

		$('#cbo_b_type').attr('disabled', true);
		if (b_type === '546') {		//공지사항
			$('#cbo_b_type').val('546');
		} else if (b_type === '547') {		//자료실
			$('#cbo_b_type').val('547');
		} else {
		$('#cbo_b_type').attr('disabled', false);
		}

	    //이벤트 핸들러 연결
  			$('#btn_search').bind('click', clickSearchButton);                      	//검색버튼 클릭
  			$('#btn_insert').bind('click', clickInsertButton);                      		//등록버튼 클릭
	});
  </script>

 <!--
컨트롤러에서 헤더, 푸터 생성.
front_header_v.php
footer_v.php 
	-->
  <div id="contents">
	<div class="left_menu">
		<h2>게시판관리</h2>
		<!--<ul>
			<li>> <a href="#">공지사항</a></li>
			<li>> <a href="#">자료실</a></li>
		</ul>-->
<?php require_once  INCLUDE_ROOT .'/mnuLeftBoard.php';?> <!-- Left menu -->

	</div>
	<div class="main">
		<div class="navi">
			<ul>
				<li><a href="#">HOME</a> > 게시판</li>	
			</ul>
		</div>
		<div class="serch">
			<form id="frm_search" method="post">
				<ul>
					<li>
						<select name="cbo_b_type" id="cbo_b_type">
								<option value="0">선택</option>
	<?php
	foreach ($btype as $bt)
	{
	?>					
								<option value="<?php echo $bt -> code_cn;?>"><?php echo $bt -> code_name;?></option>
	<?php
	}
	?>
							</select> 
						<select><option>제목+내용</option></select> 
						<input type="text" name="txt_keyword" id="txt_keyword">
					 <button name="btn_search" id="btn_search"><img src="<?php echo IMG_DIR?>/serch_btn.jpg"></button>
<?php 
		if ($this ->session ->userdata['auth_code'] == '0')
		{
?>
					 <button type="button" name="btn_insert" id="btn_insert">등록</button>
				 	<!-- <img name="btn_insert" id="btn_insert" src="<?php echo IMG_DIR?>/bt_joinok.gif" alt="게시판등록"> -->
<?php
		}
?>
					</li>
				</ul>
			</form>
		</div>
		
		<div  class="bbs1">
			<ul>
				<table class="tb_ty1" cellspaCodeIgniterng="0" cellpadding="0">
						<colgroup>
							<col width="93">
							<col width="120">
							<col width="380">
							<col width="145">
							<col width="90">
							<col width="90">
						</colgroup>					
					<thead>
						<tr>
							<th scope="col">번호</th>
							<th scope="col">게시판종류</th>
							<th scope="col">제목</th>
							<th scope="col">작성자</th>
							<th scope="col">조회수</th>
							<th scope="col">작성일</th>
						</tr>
					</thead>
					<tbody>
<?php
foreach ($list as $lt)
{
?>					<tr>
							<th scope="row">
								<?php echo $lt->board_cn;?>
							</th>
							<td><?php echo $lt->type_code_cn;?></td>
							<td>
								<a class="hyper_title" rel="external" href="/index.php/<?php echo $this->uri->segment(1);?>
								/<?php echo $view_type?>/<?php echo $lt->board_cn;?>"><?php echo $lt->subject;?>
								</a>
							</td>
							<td><?php echo $lt->member_id;?></td>
							<td><?php echo $lt->hits;?></td>
							<td><?php echo $lt->reg_date;?></td>
						</tr>
<?php
}
?>
					</tbody>
					<tfoot>
						<tr>
							<th style="text-align: center;" colspan="6"><?php echo $pagination;?>></th>
						</tr>
					</tfoot>
				</table>
			</ul>
		</div>
  </div>

