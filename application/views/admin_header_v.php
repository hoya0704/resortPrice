<!doctype html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name="apple-mobile-web-app-capable" content="yes" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<link rel="stylesheet" href="<?php echo CSS_ROOT?>/style.css" type="text/css"/>  
		<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script> 
		<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
		<script src="//cdn.ckeditor.com/4.5.4/standard/ckeditor.js"></script>
		<title>레저리조트입니다.</title>
		<!--[if lt IE 9]>
		<script src = "http://html5shiv.googlecode.com/svn/trunk/html5.js></script>"
		<![endif]-->

	</head>
	<body>
		<div id="header">
			<div class="gnb">
				<header id="header" data-role="header">		<!--Header Start -->
					<blockquote>
						<p><li>[관리자]
		<?php
		if (@$this ->session ->userdata['logged_in'] == TRUE)
		{
		 echo $this ->session ->userdata['id']
		 ?>			님 환영합니다. 
		 						<a href="<?php echo LOCAL_PATH ?>/index.php/auth/logout">로그아웃</a> | 
		 						<a href="<?php echo LOCAL_PATH ?>/index.php/member/view/<?php echo $this ->session ->userdata['id']?>">정보수정</a>
		<?php
		} else {
		?><a href="<?php echo LOCAL_PATH?>/index.php/auth">로그인</a>
		<?php
		}
		?>
						</li></p>
					</blockquote>
				</header>		<!--Header End -->
			</div>
			<nav id="gnb">		<!--gnb Start -->	
				<div class="menu">
					<h1><img src="/include/images/top_logo.jpg"></h1>
					<ul>
						<li><a href="/index.php/member/">회원관리</a></li>	
						<li><a href="/index.php/resort/">리조트관리</a></li>
						<li><a href="/index.php/reservation/">예약관리</a></li>
						<li><a href="/index.php/board/lists/BOARD/">게시판관리</a></li>
					</ul>
				</div>
			</nav>		<!--gnb End -->
		</div>