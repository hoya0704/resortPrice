<!--
컨트롤러에서 헤더, 푸터 생성.
front_header_v.php
footer_v.php
	-->
	
  <div id="contents">	
	<div class="left_menu">
		<?php require_once  INCLUDE_ROOT .'/mnuLeftBoard.php';?> <!-- Left menu -->
	</div>
	<div class="main">
		<div class="navi">
			<ul>
				<li><a href="#">HOME</a> > 공지사항</li>	
			</ul>
		</div>
<!-- 		<form name="write_board" id="write_board" method="post" action=""> -->
<?php
 $attributes = array('class' => 'form_horizontal', 'id' => 'write_board');
 echo form_open_multipart('index.php/board/write_notice',  $attributes);
?>
			<div  class="bbs1">
				<ul>
					<li>
						<table class="tb_ty1">
							<colgroup>
								<col width="145">
								<col width="550">
	<!-- 					<col width="145">
								<col width="210"> -->
							</colgroup>
							<tr>
								<th>작성자</th>
								<td><?php echo $this ->session ->userdata['id']?></td>
							</tr>
							<tr>
								<th>제목</th>
								<td><input type="text" style="width:525px" name="txt_subject" id="txt_subject">
								</td>
							</tr>
							<tr>
								<th>내용</th>
								<td><textarea style="width:525px;height:120px;margin:3px 0"  name="txt_contents" id="txt_contents" rows="10" cols="80">
										</textarea>
								</td>
							</tr>
						<tr>
							<th>첨부파일</th>
							<td>
								<input type="file" class="input-xlarge" id="file_upload" name="file_upload">				
							</td>
						</tr>			
						</table>
					</li>
					<li class="btn">
						 <img name="btn_insert" id="btn_insert" src="<?php echo IMG_DIR?>/btn3.jpg" alt="저장하기">
						 <a href="<?php echo LOCAL_PATH?>/index.php/board/lists/BOARD/b_type/546/"><img src="<?php echo IMG_DIR?>/btn4.jpg" alt="취소하기"></a>
					</li>
				</ul>
			</div>
		</form>	
	</div>
  </div>
    <!-- javascript 영역 -->
  <script src="<?php echo JS_ROOT?>/common/common.js"></script>    
  <script src="<?php echo JS_ROOT?>/boardNoticeWrite.js"></script> 
  <!-- javascript 영역 끝-->  
