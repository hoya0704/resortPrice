<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
* 사용자 인증 모델
*
**/

class Auth_m extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}

/**
* 아이디, 비밀번호 체크
* @param array $auth  폼 전송받은 아이디, 비밀번호
* @return array
**/
	function login($auth)
	{
		$sql = " SELECT M.id, M.auth_code, M.active, MD.title, MD.major_name 
						FROM MEMBER M LEFT OUTER JOIN MEMBER_DETAIL MD  ON  M.id = MD.id
						WHERE M.id =  '" .$auth['id'] . "' 
						AND M.pw = '" .$auth['pw'] . "' ";

		$query = $this ->db -> query($sql);

		if ($query -> num_rows() > 0)
		{
			//맞는 데이터가 있다면 해당 내용 반환
			return $query -> row();
		}
		else
		{
			//맞는 데이터가 없을 경우
			return FALSE;
		}
	}

}