<?php
defined('BASEPATH') OR exit('No direct script access allowed');

//메시지 출력 후 이동
function alert($msg='이동합니다.', $url = '')
{
	$CI =& get_instance();
	echo "<meta http-equiv = \"content-type\" content = \"text/html; charset = " .$CI->config->item('charset') . "\">";
	echo "<script>
					alert('".$msg."');
					location.replace('" .$url ."');
				</script> ";
	exit;
}

//창 닫기
function alert_close($msg)
{
	$CI =& get_instance();
	echo "<meta http-equiv = \"content-type\" content = \"text/html; charset = " .$CI->config->item('charset') . "\">";
	echo "<script> alert('" .$msg."'); window.close(); </script>";
	exit;
}

//경고창만
function alert_only($msg, $exit = TRUE)
{
	echo "<meta http-equiv = \"content-type\" content = \"text/html; charset = " .$CI->config->item('charset') . "\">";
	echo "<script> alert('" .$msg."'); </script>";
	if ($exit) exit;
}

function replace($url='/')
{
	echo "<script> ";
	if ($url) echo "window.location.replace('" .$url ."');";	
	echo "<script> ";
	exit;
}

/* End of file */