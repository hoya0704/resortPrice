<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ajax_common extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->model('common_m');
	}

	/**
		* 주소에서 메서드가 생략되었을 때 실행되는 기본 메서드
	**/
	public function index()
	{
		$up_code_cn = $this -> input ->post("p_up_code_cn", TRUE);
		$target_name = $this -> input ->post("p_target_name", TRUE);

// echo 	$target_name ."1111";
		
		switch ($target_name) {
			case 'cbo_resort':				//리조트 선택 샐랙트박스, up_code_cn : 상위코드cn
					$this->get_resort_list($up_code_cn);
				break;
			case 'cbo_room':				//객실선택 샐랙트박스, up_code_cn : 상위코드cn
					$this->get_room_list($up_code_cn);
				break;
			case 'txt_id':					//id중복체크, up_code_cn : id
					$this->check_id_dulp($up_code_cn);
				break;
			case 'btn_change_pw':					//비밀번호변경, up_code_cn : 변경비밀번호
					$id = $this -> input ->post("p_id", TRUE);
					$old_pw= $this -> input ->post("p_old_pw", TRUE);

					$this->change_pw($id, $old_pw, $up_code_cn);
				break;	
			case 'btn_permit':					//가입승인
					$id = $this -> input ->post("p_id", TRUE);
					$this->active_user($id);	
				break;
			case 'btn_deny':					//가입취소
					$id = $this -> input ->post("p_id", TRUE);
					$this->deactive_user($id);	
				break;
			default:
					$this->get_common_code_list($up_code_cn);
				break;
		}

/*
		if ($target_name == "cbo_resort")
		{
			$this->get_resort_list($up_code_cn);
		}
		else
		{
			$this->get_common_code_list($up_code_cn);
		}
*/
	}
	public function get_common_code_list($p_up_code_cn)
	{

		$data['list'] =$this->common_m->get_common_code_list($p_up_code_cn);
		$this->load->view('ajax/common_selectbox_v', $data);	
	}
	public function get_resort_list($p_local_code_cn)
	{
		$data['list'] =$this->common_m->get_resort_list($p_local_code_cn);
		$this->load->view('ajax/common_selectbox_v', $data);	
	}
	public function get_room_list($p_resort_cn)
	{
		$data['list'] =$this->common_m->get_room_list($p_resort_cn);
		$this->load->view('ajax/common_selectbox_v', $data);	
	}
	public function check_id_dulp($p_id)
	{
		 $countID =$this->common_m->get_id_dulp_check($p_id);
		 echo $countID;
		//$this->load->view('ajax/common_selectbox_v', $data);	
	}
	public function change_pw($p_id, $p_old_pw, $p_new_pw)
	{
		 $result =$this->common_m->update_pw($p_id, $p_old_pw, $p_new_pw);
		 echo $result;			//success : 변경성공, FALSE : 실패
		//$this->load->view('ajax/common_selectbox_v', $data);	
	} 
	public function active_user($p_id)		//가입승인
	{
		 $result =$this->common_m->update_active($p_id);
		 echo $result;			//success : 업데이트성공, FALSE : 실패
	}
	public function deactive_user($p_id)		//가입취소
	{
		 $result =$this->common_m->update_deactive($p_id);
		 echo $result;			//success : 업데이트성공, FALSE : 실패
	}

}