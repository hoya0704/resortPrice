<?php
include_once INCLUDE_ROOT.'/dbConst.php';
	
//DB Connect
$db_server = mysql_connect($DB_HOST, $DB_USER, $DB_PW);
if (!$db_server) die("데이터베이스 접속에 실패하였습니다. MySQL: ".mysql_error());

//데이터베이스 선택
mysql_select_db($DB_DATABASE) or die("데이터베이스 명이 잘못되었습니다. : " . mysql_error());
?>