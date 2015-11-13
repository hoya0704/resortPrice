<!doctype html>
<html>
  <head>
    <meta charset="UTF-8">
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
    <link rel="stylesheet" href="<?php echo CSS_ROOT?>/style.css" type="text/css"/>  
    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script> 
    <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
    <title>레저리조트입니다.</title>
    <script>
    var clickLogin = function (){
        //console.log(123);
        document.login.submit();
    };
    var keypressEnter = function(){
      if(event.keyCode == 13){
        document.login.submit();
       }
    };

    $(document).ready(function () {

  //이벤트 핸들러 연결
  $('#btn_login').bind('click', clickLogin);                                        //로그인 클릭  
  $('#txt_id').bind('keypress', keypressEnter); 
  $('#txt_pw').bind('keypress', keypressEnter); 
});
    </script>
  </head>
  <body>
  <div id="wrap">
  <div class="login">
      <article>
        <form name="login" id="login" method="post" action="" class="">
            <ul>
              <h1><img src="<?php echo IMG_DIR?>/login_title.jpg" alt="리조트프라이스 에약시스템"></h1>
              <li class="type1">
                <h2><img src="<?php echo IMG_DIR?>/login_img1.jpg" alt="로그인"></h2>
                <p>
                  <img id="btn_login" src="<?php echo IMG_DIR?>/login_img4.jpg" alt="로그인">
                  <!-- <button id="btn_login"><img  src="<?php echo IMG_DIR?>/login_img4.jpg" alt="로그인"></button> -->
                </p>
                <dl>      
                  <dt><img src="<?php echo IMG_DIR?>/login_img2.jpg" alt="아이디"></dt>
                  <!--<dd><input type="text" class="over"></dd>-->
                  <dd><input type="text" class="input-xlarge" name="txt_id" id="txt_id" value="<?php echo set_value('txt_id'); ?>">
                    <p class="help-block"></p></dd>
                </dl>
                <dl>
                  <dt><img src="<?php echo IMG_DIR?>/login_img3.jpg" alt="비밀번호"></dt>
                  <dd><input type="password" class="input-xlarge" name="txt_pw" id="txt_pw" value="<?php echo set_value('txt_pw'); ?>">
                    <p class="help-block"></p></dd>
                </dl>
              </li>
<!--        <div>
                <p class ="help-block"><?php echo validation_errors(); ?></p>
              </div> -->
              <li class="type2"><img src="<?php echo IMG_DIR?>/login_img8.jpg" ><br>
                <a href="<?php echo LOCAL_PATH?>/index.php/member/write">
                  <img src="<?php echo IMG_DIR?>/login_img9.jpg" alt="회원가입">
                </a>
              </li>
            </ul>
        </form>
      </article>
      <div id="footer">
        <ul>
          <li><img src="/include/images/foot_logo.jpg"></li>
          <li>리조트프라이스 / 주식회사 케이아이시티(여행사업부)<br>
            서울시 강남구 테헤란로 98길 6-9 티아이티워8층<br>
            TEL 070-8233-0508, 070-8233-0509. FAX. 02-6280-0497<br>
            Email. sales@resortprice.co.kr
          </li>
        </ul>
      </div>
  </div>
</div>
  </body>
</html>
