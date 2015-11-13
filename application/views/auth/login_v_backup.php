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
  <title>레저리조트입니다.</title>
  <!--[if lt IE 9]>
  <script src = "http://html5shiv.googlecode.com/svn/trunk/html5.js></script>"
  <![endif]-->
  
 </head>
 <body>
  <div id="wrap">
  <div class="login">
	<ul>
		<h1><img src="<?php echo IMG_DIR?>/login_title.jpg" alt="리조트프라이스 에약시스템"></h1>
		<li class="type1">
		<h2><img src="<?php echo IMG_DIR?>/login_img1.jpg" alt="로그인"></h2>
		<p><a href="#"><img src="<?php echo IMG_DIR?>/login_img4.jpg" alt="로그인"></a></p>
		<dl>			
			<dt><img src="<?php echo IMG_DIR?>/login_img2.jpg" alt="아이디"></dt>
			<dd><input type="text" class="over"></dd>
		</dl>
		<dl>			
			<dt><img src="<?php echo IMG_DIR?>/login_img3.jpg" alt="비밀번호"></dt>
			<dd><input type="text" class="off"></dd>
		</dl>
		</li>
		<li class="type2"><img src="<?php echo IMG_DIR?>/login_img8.jpg" ><br><a href="<?php echo LOCAL_PATH?>/index.php/member/write"><img src="<?php echo IMG_DIR?>/login_img9.jpg" alt="회원가입"></a></li>
	</ul>
  </div>
  <div id="footer">
		<?php include_once  INCLUDE_ROOT .'/mnuFooter.php';?> <!-- Footer menu -->
  </div>
  </div>
 </body>
</html>
