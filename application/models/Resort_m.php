<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
* 리조트 모델
*
**/

class Resort_m extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}

	function get_list($table = 'RESORT', $type='', $offset='', $limit='', $search_word = '')
	{
		$sword = '';
		$table = " RESORT ";
		if ( $search_word != '' )
		{
			//검색어가 있을 경우의 처리
			//$sword = " AND subject like '%" .$search_word . "%' or contents like '%"  .$search_word . "%'" ;
		}
		$limit_query = '';

		if ($limit != '' OR $offset !='')
		{
			//페이징이 있을 경우의 처리
			$limit_query = ' LIMIT ' .$offset. ', '.$limit;
		}


		$sql0 = "SET @rownum :=0";
		$query = $this->db->query($sql0);

		$sql = "
						SELECT @rownum:=@rownum + 1 AS no, fn_getComCodeName(local_code_cn) AS area
									, fn_getComUpCodeName(local_code_cn) AS nation
									, title_us, fn_getComCodeName(grade_code_cn) AS grade
									, DATE_FORMAT(reg_date, '%Y-%m-%d') AS create_date
									, resort_cn
					 	FROM " .$table
					 	. " WHERE active = 'Y' ".$sword 
					 	." ORDER BY reg_date DESC" .$limit_query;
		$query = $this->db->query($sql);
		$result = $query->result();

		if ($type =='count')
		{
			//리스트를 반환하는 것이 아니라 전체 게시물의 개수를 반환
			$result = $query->num_rows();
		}
		else
		{
			//게시물 리스트 반환
			$result = $query->result();
		}
		return $result;
	}

	/**
	*리조트 상세보기 가져오기
	*@param string $table 예약 테이블
	*@param string $id 예약cn
	*@return array
	*/
	function get_view($table, $id)
	{
		$sql = " SELECT fn_getComUpCodeName(local_code_cn) AS nation
										, fn_getComCodeName(local_code_cn) AS area
										, fn_getComCodeName(grade_code_cn) AS grade
										, grade_code_cn
										, title_kr, title_us, address, tel, fax
										, room_code_cns, meal_code_cns, vehicle_code_cns
										, special, honeymoon_privilege, inclusion, exclusion, active
					FROM  RESORT
					WHERE resort_cn = '" .$id."'";
		$query = $this -> db -> query($sql);

		//예약 내용 반환
		$result = $query -> row();

		return $result;
	}

	/**
	*리조트 입력
	*@param string  RESORT 테이블 필드값들
	*/
	function insert_resort($local_code_cn, $grade_code_cn, $title_kr, $title_us
																			, $address, $tel, $fax, $room_code_cns, $meal_code_cns
																			, $vehicle_code_cns, $special, $honeymoon_privilege
																		 	, $inclusion, $exclusion )
	{
		$sql = " INSERT INTO RESORT (local_code_cn, grade_code_cn, title_kr, title_us
																		, address, tel, fax, room_code_cns, meal_code_cns
																		, vehicle_code_cns, special, honeymoon_privilege
																		, inclusion, exclusion ) 
									VALUES ('$local_code_cn', '$grade_code_cn', '$title_kr', '$title_us'
														, '$address', '$tel', '$fax', '$room_code_cns', '$meal_code_cns'
														, '$vehicle_code_cns', '$special', '$honeymoon_privilege'
													 	, '$inclusion', '$exclusion') " ;

		$query = $this ->db -> query($sql);	
	}
}