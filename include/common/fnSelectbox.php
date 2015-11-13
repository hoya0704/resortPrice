<?php
include_once INCLUDE_ROOT.'/fnDbConn.php';
/*그룹별 공통코드(COMMON_CODE) 가져오기
PARAM : $p_up_code_cn - 상위코드cn
*/

function fnSelectCommCodes($p_up_code_cn)	
{
	$query = 	"SELECT * FROM COMMON_CODE WHERE up_code_cn = '" .$p_up_code_cn ."' ORDER BY order_no";

	mysql_query("SET NAMES UTF8");
	$result = mysql_query($query);
	$rows = mysql_num_rows($result);

	$return_html  = '';
	for ($j = 0; $j <  $rows; ++$j)
	{
		$row = mysql_fetch_row($result);

		$return_html  = $return_html .'<option value=' .$row[0]  .'>' .$row[1] .'</option>';
	}

	if (!$result) die ("Error! : " .mysql_error());
	return $return_html ;
	/**/
}

function fnCheckboxCommCodes($p_up_code_cn, $p_check_name)
{
	$query = 	"SELECT * FROM COMMON_CODE WHERE up_code_cn = '" .$p_up_code_cn ."' ORDER BY order_no";
	mysql_query("SET NAMES UTF8");
	$result = mysql_query($query);
	$rows = mysql_num_rows($result);

	//echo $query;
	//exit;

	$return_html  = '';
	for ($j = 0; $j <  $rows; ++$j)
	{
		$row = mysql_fetch_row($result);
		$return_html  = $return_html .' <label><input type="checkbox" name="'.$p_check_name.'" id="'.$p_check_name.'_'.$j.'" value ="' .$row[0]  .'">' .$row[1].'</label> ' ;
	}

	if (!$result) die ("Error! : " .mysql_error());

//echo return_html;
//exit;
	return $return_html ;
}

?>