<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
* 공용 모델
*
**/
class Common_m extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}
	public function get_common_code_list($p_up_code_cn)
	{
		$sql = "SELECT code_cn, code_name FROM COMMON_CODE WHERE active = 'Y' AND up_code_cn = '" .$p_up_code_cn. "'";
		$query = $this->db->query($sql);
		$result = $query->result();
		
		//공통코드반환
		$result = $query->result();

		return $result;
	}
	public function get_resort_list($p_local_code_cn)
	{
		$sql = "SELECT resort_cn as code_cn, title_us as code_name FROM RESORT WHERE active = 'Y' AND local_code_cn = '" .$p_local_code_cn. "'";
		$query = $this->db->query($sql);
		$result = $query->result();
		
		//공통코드반환
		$result = $query->result();

		return $result;
	}


	public function get_room_list($p_resort_cn)
	{
		$sql = "SELECT  code_cn, code_name 
						FROM COMMON_CODE 
						WHERE code_cn 
										IN (SELECT room_code_cns FROM RESORT WHERE active = 'Y' AND resort_cn = '" .$p_resort_cn. "')" ;

										//echo $sql;
		$query = $this->db->query($sql);
		$result = $query->result();
		
		//공통코드반환
		$result = $query->result();

		return $result;
	}

	public function get_id_dulp_check($p_id)
	{
		$sql = "SELECT  count(*) AS count
						FROM MEMBER 
						WHERE id = '" .$p_id. "'" ;

//										echo $sql;
		$query = $this->db->query($sql);

		if ($query -> num_rows() > 0)
		{
			//맞는 데이터가 있다면 해당 내용 반환
			return $query -> row('count');
		}
		else
		{
			//맞는 데이터가 없을 경우
			return FALSE;
		}
//		$result = $query->result();
		
		//결과값반환
//		$result = $query->result();
//echo $result;
		//return $result;
	}

	/*
	*이전 비밀번호 확인 및 비밀번호변경
	*@param
	*@result
	*/
		public function update_pw($p_id, $p_old_pw, $p_new_pw)
	{
		$sql = "SELECT  count(*) AS count
						FROM MEMBER 
						WHERE id = '" .$p_id. "'
						AND pw ='" .$p_old_pw . "'";

		$query = $this->db->query($sql);

		if ($query -> num_rows() > 0)
		{
			// return $query -> row('count');
			$sql = " UPDATE MEMBER SET pw = '".$p_new_pw."' WHERE id = '".trim($p_id)."'";
			$query = $this->db->query($sql);
// echo $sql;
			return 'success';
		}
		else
		{
			//맞는 데이터가 없을 경우
			return FALSE;
		}
//		$result = $query->result();
		
		//결과값반환
//		$result = $query->result();
//echo $result;
		//return $result;
	}

	/*
	*가입승인 : active = 'Y'
	*@param $p_id id
	*@result
	*/
		public function update_active($p_id)
		{
				$sql = " UPDATE MEMBER SET active = 'Y' WHERE id = '".trim($p_id)."'";
				$query = $this->db->query($sql);
	// echo $sql;
				return 'success';
		}


	/*
	*가입취소 : active = 'N'
	*@param $p_id id
	*@result
	*/
		public function update_deactive($p_id)
		{
				$sql = " UPDATE MEMBER SET active = 'S' WHERE id = '".trim($p_id)."'";
				$query = $this->db->query($sql);
	// echo $sql;
				return 'success';
		}


}