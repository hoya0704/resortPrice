<?php
//세션정보 권한체크하여 메뉴에 관리자/사용자 메뉴 구분해야함..
/*
echo <<<_END
		<ul>
			<li><a href="#">로그아웃</a> | <a href="#"><a href="adminMakeId.html">정보수정</a></li>
		</ul>
	</div>
	<div class="menu">
		<h1><img src="../images/top_logo.jpg"></h1>
		<ul>
			<li><a href="booking.html">예약하기</a></li>
			<li><a href="reserveList.html">예약목록</a></li>
			<li><a href="dataroomList.html">자료실</a></li>
			<li><a href="noticeList.html">공지사항</a></li>
		</ul>
_END;
*/
echo <<<_END
		<ul>
			<li>> <a href="/index.php/board/lists/BOARD/b_type/546/">공지사항</a></li>
			<li>> <a href="/index.php/board/lists/BOARD/b_type/547/">자료실</a></li>				
		</ul>
_END;
?>
