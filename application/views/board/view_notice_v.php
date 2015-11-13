	<script>
function fileDownload (fileName){
//  alert(filename);
// location.href = './upload' + filename;

 var file = encodeURI(fileName);
	var option = "width=1024,height=768,scrollbars=yes,resizable=yes";
	// window.open("./upload/"+file ,"",option); INCLUDE_ROOT
	 window.open("<?php echo LOCAL_PATH?>/upload/"+file ,"",option);
}
	</script>

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
							<td><?php echo $views -> member_id?></td>
						</tr>
						<tr>
							<th>제목</th>
							<td><?php echo $views -> subject?></td>
						</tr>
						<tr>
							<th>내용</th>
							<td><div style="width:525px;height:120px;margin:3px 0" ><?php echo $views -> contents?></div></td>
						</tr>
						<tr>
							<th>첨부파일</th>
							<td><a href="javascript:fileDownload('<?php echo $views -> file_name?>')"><?php echo $views -> original_name?></a></td>
						</tr>
					</table>
				</li>
			</ul>
		</div>
	</div>
  </div>
    <!-- javascript 영역 -->
  <script src="<?php echo JS_ROOT?>/common/common.js"></script>    
  <script src="<?php echo JS_ROOT?>/memberView.js"></script> 
  <!-- javascript 영역 끝-->  
  </div>
 </body>
</html>
