<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
* 공통 게시판 모델
*
**/
class Board_m extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}

	function get_list($table = 'BOARD', $type='', $offset='', $limit='', $search_word = '', $board_type = '')
	{
		$sword = '';
		$table = 'BOARD';

		if ( $search_word != '' )
		{
			//검색어가 있을 경우의 처리
			$sword = " AND subject like '%" .$search_word . "%' or contents like '%"  .$search_word . "%'" ;
		}

		if ( $board_type != '' )
		{
			//게시판 구분
			$sword .= " AND type_code_cn = '$board_type'" ;
		}		

		$limit_query = '';

		if ($limit != '' OR $offset !='')
		{
			//페이징이 있을 경우의 처리
			$limit_query = ' LIMIT ' .$offset. ', '.$limit;
		}


		$sql = "SELECT board_cn, member_id, subject, contents, hits,  DATE_FORMAT(reg_date, '%Y-%m-%d') reg_date
									, fn_getComCodeName(type_code_cn) AS type_code_cn 
						FROM " .$table
						." WHERE 1=1 "
									.$sword
									.  " ORDER BY board_cn DESC" .$limit_query;

 // echo $sql;		
		$query = $this->db->query($sql);
		
		//$result = $query->result();
		
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

	function get_view($table, $id)
	{
		//조회수 증가
		$sql = "UPDATE  $table SET hits = hits + 1 WHERE board_cn = '" .$id."'";
		$this -> db ->query($sql );
		
		$sql = " SELECT * 
					FROM BOARD B LEFT OUTER JOIN ATTACH_FILES A ON B.board_cn = A.ref_cn
					WHERE board_cn = '" .$id."'";
		$query = $this -> db -> query($sql);
// echo $sql;
		//게시판 내용 반환
		$result = $query -> row();

		return $result;
	}

/**
* 게시판 입력
*
**/
function insert_board($arrays)
{
	$insert_array = array(
			'type_code_cn'=>$arrays['type_code_cn']			//게시판타입
			, 'member_id' =>$arrays['member_id']
			, 'subject' =>$arrays['subject']
			, 'contents' =>$arrays['contents']
		);

// print_r($insert_array);
// exit;

	$this -> db ->insert('BOARD', $insert_array);
	$result = $this -> db ->insert_id();

 	//결과 반환
	return $result;
}

function insert_attach_file($arrays)
{
//ATTACH_FILE INSERT
	$detail = array(
		'file_size' =>(int)$arrays['file_size']
		, 'image_width' =>$arrays['image_width']
		, 'image_height' =>$arrays['image_height']
		, 'file_ext' =>$arrays['file_ext']
		);

	$file_arrays = array(
			'ref_table_name'=>'ATTACH_FILE'
			, 'ref_cn' =>$arrays['ref_cn']
			, 'file_path' =>$arrays['file_path']
			, 'file_name' =>$arrays['file_name']
			, 'original_name' =>$arrays['orig_name']
			, 'detail_info' =>serialize($detail)
			// , 'reg_date' =>date("Y-m-d H:i:s")
		);

// print_r($insert_array);
// exit;

	$this -> db ->insert('ATTACH_FILES', $file_arrays);
	
	$result = $this -> db ->insert_id();
 	//결과 반환
	return $result;
}

function update_board($arrays)
{
	$update_array = array(
			'type_code_cn'=>$arrays['type_code_cn']
			, 'member_id' =>$arrays['member_id']
			, 'subject' =>$arrays['subject']
			, 'contents' =>$arrays['contents']
		);

	$where = array('id' => $arrays['id']);
	$result = $this -> db ->update('BOARD', $modify_array, $where);

// 	//결과 반환
	return $result;
}

}