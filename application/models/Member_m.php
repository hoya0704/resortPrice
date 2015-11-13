<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
* 회원 모델
*
**/

class Member_m extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}

	function get_list($table = 'MEMBER', $type='', $offset='', $limit='', $search_word = '')
	{
		$sword = '';
		$table = " MEMBER_DETAIL MD JOIN MEMBER MM ON MD.id = MM.id ";
		if ( $search_word != '' )
		{
			//검색어가 있을 경우의 처리
			$sword = " WHERE subject like '%" .$search_word . "%' or contents like '%"  .$search_word . "%'" ;
		}
		$limit_query = '';

		if ($limit != '' OR $offset !='')
		{
			//페이징이 있을 경우의 처리
			$limit_query = ' LIMIT ' .$offset. ', '.$limit;
		}

		$sql0 = "SET @rownum := ".(int)$offset;
		$query = $this->db->query($sql0);
		$order_num = $offset + 1;
		$sql = "
						SELECT @rownum :=@rownum  + 1 AS no, MM.id
						, DATE_FORMAT(MM.reg_date, '%Y-%m-%d') AS join_date
						, MD.title
						, CONCAT(MD.reg_no,'-', MD.reg_no2,'-', MD.reg_no3) AS reg_no
						, CONCAT(MD.tel, '-', MD.tel2, '-',  MD.tel3) AS tel
						, CONCAT(MD.fax, '-', MD.fax2, '-', MD.fax3) AS fax
						, MD.major_name, CONCAT(MD.major_mobile, '-', MD.major_mobile2, '-', MD.major_mobile3) AS mobile
						, CASE(MD.email_id) WHEN '' THEN '-' ELSE CONCAT(MD.email_id, '@', MD.email_domain) END AS email
						, IFNULL(MD.homepage, '-') AS homepage
						, CASE(MM.active) WHEN 'Y'	THEN '승인' WHEN 'S'	THEN '계정중지' ELSE '미승인' END AS active 
						, MM.reg_date
									 FROM " .$table.$sword.  " ORDER BY MM.reg_date DESC" .$limit_query;
 // echo $sql;
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
	*회원 상세보기 가져오기
	*@param string $table 예약 테이블
	*@param string $id 예약cn
	*@return array
	*/
	function get_view($table, $id)
	{
//echo $table ."</br>";
//echo $id ."</br>";
		$sql = " SELECT * 
					FROM MEMBER_DETAIL MD RIGHT OUTER JOIN MEMBER MM ON MD.id = MM.id
					WHERE MM.id = '" .$id."'";
		$query = $this -> db -> query($sql);
//echo $sql;

		//회원정보 반환
		$result = $query -> row();

		return $result;
	}

	function insert_member($id, $pw, $auth_code, $president_name, $title, $reg_no, $reg_no2, $reg_no3
																			, $biz_type, $biz_item, $zip_code, $zip_code2 , $address , $addr_detail, $tel , $tel2 , $tel3 
																			, $fax , $fax2 , $fax3 , $major_name , $major_mobile, $major_mobile2 , $major_mobile3 
																		 	, $email_id, $email_domain, $homepage )
	{
		$sql = " INSERT INTO MEMBER (id, pw, auth_code) VALUES ('$id', '$pw', '1') " ;
		$query = $this ->db -> query($sql);

		$sql = " INSERT INTO MEMBER_DETAIL (id, president_name, title, reg_no, reg_no2, reg_no3
											, biz_type, biz_item, zip_code, zip_code2, address, addr_detail, tel, tel2, tel3
											, fax, fax2, fax3, major_name, major_mobile, major_mobile2, major_mobile3
											, email_id, email_domain, homepage) 
									VALUES ('$id', '$president_name', '$title', '$reg_no', '$reg_no2', '$reg_no3'
														, '$biz_type', '$biz_item', '$zip_code', '$zip_code2' , '$address' , '$addr_detail', '$tel' , '$tel2' , '$tel3' 
														, '$fax' , '$fax2' , '$fax3' , '$major_name' , '$major_mobile', '$major_mobile2' , '$major_mobile3' 
													 	, '$email_id', '$email_domain', '$homepage') " ;
		$query = $this ->db -> query($sql);	
	}

/*
*@param array $arrays 수정 컬럼명 1차 배열
*@return boolean 수정 성공 여부.
*/
function update_member($arrays)
{
	$modify_array = array(
			'president_name' =>$arrays['president_name']
			, 'title' =>$arrays['title']
			, 'reg_no' =>$arrays['reg_no']
			, 'reg_no2' =>$arrays['reg_no2']
			, 'reg_no3' =>$arrays['reg_no3']
			, 'biz_type' =>$arrays['biz_type']
			, 'biz_item' =>$arrays['biz_item']
			, 'zip_code' =>$arrays['zip_code']
			, 'zip_code2' =>$arrays['zip_code2']
			, 'address' =>$arrays['address']
			, 'addr_detail' =>$arrays['addr_detail']
			, 'tel' =>$arrays['tel']
			, 'tel2' =>$arrays['tel2']
			, 'tel3' =>$arrays['tel3']
			, 'fax' =>$arrays['fax']
			, 'fax2' =>$arrays['fax2']
			, 'fax3' =>$arrays['fax3']
			, 'major_name' =>$arrays['major_name']
			, 'major_mobile' =>$arrays['major_mobile']
			, 'major_mobile2' =>$arrays['major_mobile2']
			, 'major_mobile3' =>$arrays['major_mobile3']
			, 'email_id' =>$arrays['email_id']
			, 'email_domain' =>$arrays['email_domain']
			, 'homepage' =>$arrays['homepage']
		);

	$where = array('id' => $arrays['id']);

	$result = $this -> db ->update($arrays['table'], $modify_array, $where);

// echo $result;
// 	//결과 반환
	return $result;
}

function update_pw($p_id, $p_pw)
{
		//id 존재여부.
		$sql = " SELECT COUNT(*) FROM MEMBER WHERE id='$p_id' AND pw='$p_pw' ";
		$query = $this->db->query($sql);	
		$count = $query->num_rows();

		if ($count > 0)
		{					//비밀번호 변경
			$sql = " UPDATE MEMBER SET ( pw = '$p_pw'
								WHERE id = '$p_id' " ;
			$query = $this ->db -> query($sql);
			$result = TRUE;
		}
		else
		{
			$result = FALSE;
		}

}
	
}
