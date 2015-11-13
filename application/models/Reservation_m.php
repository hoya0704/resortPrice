<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
* 예약 모델
*
**/

class Reservation_m extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}

	function get_list($table = 'RESERVATION', $type='', $offset='', $limit='', $search_word = '')
	{
		$sword = '';
		$table = " RESERVATION RV JOIN RESORT RS ON RV.resort_cn = RS.resort_cn ";
		if ( $search_word != '' )
		{
			//검색어가 있을 경우의 처리
			//$sword = " WHERE subject like '%" .$search_word . "%' or contents like '%"  .$search_word . "%'" ;
		}
		$limit_query = '';

		if ($limit != '' OR $offset !='')
		{
			//페이징이 있을 경우의 처리
			$limit_query = ' LIMIT ' .$offset. ', '.$limit;
		}


		$sql = "SELECT reservation_cn, DATE_FORMAT(RV.reg_date, '%Y-%m-%d') reg_date
									, DATE_FORMAT(checkin_date, '%Y-%m-%d') checkin_date
									, DATE_FORMAT(checkout_date, '%Y-%m-%d') checkout_date
									, CONCAT(RS.title_kr, '|', RS.title_us) resort, client1, client2, status
									 FROM " .$table.$sword.  " ORDER BY reservation_cn DESC" .$limit_query;
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
	*예약 상세보기 가져오기
	*@param string $table 예약 테이블
	*@param string $id 예약cn
	*@return array
	*/
	function get_view($table, $id)
	{
		$sql = " SELECT * 
					FROM RESERVATION RV JOIN RESORT RS ON RV.resort_cn = RS.resort_cn
					WHERE RV.reservation_cn = '" .$id."'";
		$query = $this -> db -> query($sql);

		//예약 내용 반환
		$result = $query -> row();

		return $result;
	}
}