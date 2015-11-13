<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
*사용자 인증 컨트롤러
*/
class Auth extends CI_Controller {
	function __construct()
	{
		parent::__construct();
			$this->load->database();
			$this->load->model('auth_m');
			$this->load->helper('form');
	}
	/**
		* 주소에서 메서드가 생략되었을 때 실행되는 기본 메서드
	**/
	public function index()
	{
		//$this->load->view('reservation/list_v');	
		$this->login();
	}

	/**
		* 로그인 처리
	**/	
	public function login()
	{
		//폼 검증 라이브러리 로드
		$this -> load -> library('form_validation');
		$this -> load -> helper('alert');

		//폼 검증할 필드와 규칙 사전 정의
		$this -> form_validation -> set_rules('txt_id', '아이디', 'required|alpha_numeric');
		$this -> form_validation -> set_rules('txt_pw', '비밀번호', 'required');

		// echo '<meta http-equiv="Content-Type" content="text/html"; charset=utf-8" />';

		if ($this -> form_validation -> run() == TRUE)
		{
			$auth_data = array(
				'id' => $this -> input -> post('txt_id', TRUE),
				'pw' => $this -> input -> post('txt_pw', TRUE)
				);

			$result = $this -> auth_m -> login($auth_data);
			
			if($result)
			{
				If ($result -> active =='Y')
				{
					//세션생성
					$newdata = array(
						'id' => $result -> id,
						'auth_code' => $result -> auth_code,
						'title' => $result -> title,
						'major_name' => $result -> major_name,
						'logged_in' => TRUE
						);
				}
				else
				{
					alert('현재 미승인 상태로 로그인이 되지 않습니다. 관리자에게 연락바랍니다.', LOCAL_PATH .'/index.php/auth');
					exit;
				}

				$this -> session -> set_userdata($newdata);

				if ($this ->session ->userdata['auth_code'] == '0')
				{
					$login_page = '/index.php/member';
				}
				else
				{
					$login_page = '/index.php/board/lists';
				}
	
				alert('로그인 되었습니다.', LOCAL_PATH .$login_page);
				exit;
			}
			else
			{
				//실패 시
				alert('로그인 정보가 일치하지 않습니다.', LOCAL_PATH .'/index.php/auth');
				exit;
			}
		}
		else 
		{
			//쓰기 폼 view 호출
			$this -> load -> view('auth/login_v');
		}		
	}

	public function logout ()
	{
		$this -> load ->helper('alert');

		$this -> session -> sess_destroy();
		echo '<meta http-equiv="Content-Type" content="text/html"; charset=utf-8" />';
		alert('로그아웃 되었습니다.', 'http://www.resortprice.co.kr' );
		exit;
	}
}