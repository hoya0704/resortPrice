<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Member extends CI_Controller {

	function __construct()
	{
		parent::__construct();
			$this-> load-> database();
			$this-> load-> helper('form');
			$this-> load-> helper('url');
			$this -> load -> helper('alert');
			$this-> load-> model('member_m');
			$this-> load-> model('common_m');
	}
	/**
		* 주소에서 메서드가 생략되었을 때 실행되는 기본 메서드
	**/
	public function index()
	{
		// $this -> forms();

		if ($this ->session ->userdata['auth_code'] != '0')
		{
				alert('권한이 없습니다. 관리자 권한으로 로그인하십시요.', LOCAL_PATH .'/index.php/reservation');
				// alert('권한이 없습니다. 관리자 권한으로 로그인하십시요.', LOCAL_PATH .'/index.php/member/view/'.  $this ->session ->userdata['id']);
				//alert('권한이 없습니다. 관리자 권한으로 로그인하십시요.');
		}
		else
		{
		//$this->load->view('member/list_v');	
			$this->lists();		
		}
	}

// 	public function forms()
// 	{
// 		$this -> load -> library('form_validation');				//폼 검증 라이브러리 로드

// 		//폼 검증할 필드와 규칙 사전 정의
// 		// $this -> form_validation -> set_rules('txt_id', '아이디', 'required|alpha_dash|min_length(5)|max_length(15)');
// 		$this -> form_validation -> set_rules('txt_id', '아이디', 'required');
// 		$this -> form_validation -> set_rules('txt_pw', '비밀번호', 'required');
// 		$this -> form_validation -> set_rules('txt_pw_confirm', '비밀번호확인', 'required');
// 		$this -> form_validation -> set_rules('txt_reg_no', '사업자등록번호', 'required');
// 		$this -> form_validation -> set_rules('txt_reg_no2', '사업자등록번호', 'required');
// 		$this -> form_validation -> set_rules('txt_reg_no3', '사업자등록번호', 'required');

// //echo $this -> form_validation -> run();
// //exit;

// 		if ($this -> form_validation -> run() == FALSE)
// 		{
// 			//폼 검증이 실패했을 경우 또는 일반 입력 페이지.
// 			$this -> load -> view('member/write_v');
// 		}
// 		else
// 		{
// 			//폼 검증이 성공했을 때 보여줄 페이지.
// 			$this -> load ->view('member/list_v');
// 		}
// 	}

	// 사이트에 헤더, 푸터가 자동으로 추가된다.
	public function _remap($method)
	{
		$header_name ="";
//관리자와 사용자 헤더 메뉴 인크루드
		if (@$this ->session ->userdata['logged_in'] == TRUE)
		{
			if (@$this ->session ->userdata['auth_code'] == '0')
			{
				$header_name  = "admin_header_v";
			}
			else
			{
				$header_name  = "front_header_v";
			}
		}
		else
		{
				$header_name  = "guest_header_v";
		}

		//if (@$this ->session ->userdata['logged_in'] == TRUE)
		//{

		//}		

		//header include
		$this ->load -> view($header_name);

		if (method_exists($this, $method))
		{
			$this -> {"{$method}"}();
		}

		//footer include
		$this ->load -> view('footer_v');
	}

/**
	*목록 불러오기
**/
	public function lists()
	{
		//$this->output->enable_profiler(TRUE);

		//검색어 초기화
		$search_word = $page_url = '';
		$uri_segment = 5;

		//주소 중에서 txt_keyword(검색어, txt_keyword) 세그먼트가 있는지 검사하기 위해 주소를 배열로 변환.
		$uri_array = $this -> segment_explode($this -> uri ->uri_string());
	
		if ( in_array('txt_keyword', $uri_array)) 
		{
			//주소에 검색어가 있을 경우의 처리. 즉 검색 시
			$search_word = urldecode($this -> url_explode($uri_array, 'txt_keyword'));

			//페이지네이션용 주소
			$page_url ='/txt_keyword/' .$search_word;
			$uri_segment = 7;
		}

//echo $url_segment;
		//페이지네이션 라이브러리 로딩 추가
		$this->load->library('pagination');

		//페이지네이션 설정
		$config['base_url'] = LOCAL_PATH.'/index.php/Member/lists/MEMBER/' .$page_url .'/page/';		//페이징 주소
		$config['total_rows'] = $this->member_m->get_list($this->uri->segment(3), 'count', '', '', $search_word);		//게시물의 전체개수
		$config['per_page'] = 15;										//한페이지에 표시할 게시물 수
		$config['uri_segment'] = $uri_segment;			//페이지 번호가 위치한 세그먼트 
		// $config['full_tag_open'] = '<p>';							//페이지네이션 전체에 감싸는 태그
		// $config['full_tag_close'] = '</p>';							//페이지네이션 전체에 감싸는 태그


		$this ->pagination->initialize($config);											//페이지네이션 초기화
		$data['pagination'] = $this->pagination->create_links();		//페이징 링크를 생성하여 view에서 사용할 변수에 할당
		$page = $this->uri->segment($uri_segment,1);
//echo $page ."</br>";
//print_r ($uri_array) ;
//echo $search_word ; 
		if ($page > 1)
		{
			$start =(($page/$config['per_page'])) * $config['per_page'];
		}
		else
		{
			$start = ($page-1) * $config['per_page'];
		}
		$limit = $config['per_page'];

		//$data['nation'] =$this->common_m->get_common_code_list(4);
		$data['list'] =$this->member_m->get_list($this->uri->segment(3), '', $start, $limit, $search_word);
		//print_r ($data);
		$this->load->view('member/list_v', $data);
	}

	/**
	*회원 보기
	*/
	function view()
	{
		// echo '<meta http-equiv="Content-Type" content="text/html"; charset=utf-8" />';

		if($_POST)
		{
			//글 수정 POST 전송 시
			//주소 중에서 page 세그먼트가 있는지 검사하기 위해 주소를 배열로 변환
			$uri_array = $this ->segment_explode($this -> uri -> uri_string());

			if(in_array('page', $uri_array))
			{
				$pages = urldecode($this -> url_explode ());
			}
			else
			{
				$pages = 1;
			}

			if (!$this -> input -> post('txt_title', TRUE) AND !$this -> input -> post('txt_president_name', TRUE))
			{
				//상호와 대표자명이 없을 경우, 프로그램단에서 한번 더 체크
				alert('비정상적인 접근입니다.', '' .$this ->uri -> segment(3) .'/page/' .$pages);
				exit;
			}

			$modify_data = array(
					// 'table' => $this -> uri -> segment(3),			//회원 테이블명(MEMBER)
					'table' => 'MEMBER_DETAIL'					//회원 테이블명(MEMBER)
					, 'id' => $this -> session -> userdata('id')		//ID(MEMBER)
					, 'president_name' => $this -> input ->post('txt_president_name', TRUE)
					, 'title' => $this -> input ->post('txt_title', TRUE)
					, 'reg_no' => $this -> input ->post('txt_reg_no', TRUE)
					, 'reg_no2' => $this -> input ->post('txt_reg_no2', TRUE)
					, 'reg_no3' => $this -> input ->post('txt_reg_no3', TRUE)
					, 'biz_type' => $this -> input ->post('txt_biz_type', TRUE)
					, 'biz_item' => $this -> input ->post('txt_biz_item', TRUE)
					, 'zip_code' => $this -> input ->post('txt_zip_code', TRUE)
					, 'zip_code2' => $this -> input ->post('txt_zip_code2', TRUE)
					, 'address' => $this -> input ->post('txt_address', TRUE)
					, 'addr_detail' => $this -> input ->post('txt_addr_detail', TRUE)
					, 'tel' => $this -> input ->post('txt_tel', TRUE)
					, 'tel2' => $this -> input ->post('txt_tel2', TRUE)
					, 'tel3' => $this -> input ->post('txt_tel3', TRUE)
					, 'fax' => $this -> input ->post('txt_fax', TRUE)
					, 'fax2' => $this -> input ->post('txt_fax2', TRUE)
					, 'fax3' => $this -> input ->post('txt_fax3', TRUE)
					, 'major_name' => $this -> input ->post('txt_major_name', TRUE)
					, 'major_mobile' => $this -> input ->post('cbo_major_mobile', TRUE)
					, 'major_mobile2' => $this -> input ->post('txt_major_mobile2', TRUE)
					, 'major_mobile3' => $this -> input ->post('txt_major_mobile3', TRUE)
					, 'email_id' => $this -> input ->post('txt_email_id', TRUE)
					, 'email_domain' => $this -> input ->post('cbo_email_domain', TRUE)
					, 'homepage' => $this -> input ->post('txt_homepage', TRUE)
				);
			
			$result = $this -> member_m -> update_member($modify_data);

			if ($result)
			{
				//정보수정 성공 시 예약목록으로
				alert('수정되었습니다.', LOCAL_PATH. '/index.php/reservation/lists/page/' .$pages);
				exit;
			}
			else
			{
				//정보수정 실패 시 수정페이지(modify_m)로
				alert('다시 수정해 주세요.', LOCAL_PATH. '/index.php/member/view/'  .$this ->uri ->segment(3) .'/id/' .$this ->uri ->segment(5)  .'/page/' .$pages);
				exit;			
			}
		}
		else
		{
			$data['mobile'] =$this->common_m->get_common_code_list(6);						//휴대폰 앞자리 샐렉트박스		
			$data['email_domain'] =$this->common_m->get_common_code_list(5);			//이메일계정 샐렉트박스		
			//게시판 이름과 게시물 번호에 해당하는 게시물 가져오기
			//$data['views'] = $this->member_m->get_view($this->uri->segment(1), $this->uri->segment(3));
			$data['views'] = $this->member_m->get_view($this->uri->segment(1), $this->uri->segment(3));			
			//수정 폼 view 호출
			$this -> load -> view('member/view_v', $data);
		}

		//view 호출
		// $this->load->view('member/view_v', $data);
	}

	function write()
	{
		$data['mobile'] =$this->common_m->get_common_code_list(6);						//휴대폰 앞자리 샐렉트박스		
		$data['email_domain'] =$this->common_m->get_common_code_list(5);			//이메일계정 샐렉트박스		

		$this -> load -> library('form_validation');				//폼 검증 라이브러리 로드

		//폼 검증할 필드와 규칙 사전 정의
		// $this -> form_validation -> set_rules('txt_id', '아이디', 'required|alpha_dash|min_length(5)|max_length(15)');
		$this -> form_validation -> set_rules('txt_title', '상호', 'required');
		$this -> form_validation -> set_rules('txt_president_name', '대표자명', 'required');
		$this -> form_validation -> set_rules('txt_id', '아이디', 'required');
		$this -> form_validation -> set_rules('txt_pw', '비밀번호', 'required|matches[txt_pw_confirm]');
		$this -> form_validation -> set_rules('txt_pw_confirm', '비밀번호확인', 'required');
		$this -> form_validation -> set_rules('txt_reg_no', '사업자등록번호', 'required');
		$this -> form_validation -> set_rules('txt_reg_no2', '사업자등록번호', 'required');
		$this -> form_validation -> set_rules('txt_reg_no3', '사업자등록번호', 'required');

		$this -> form_validation -> set_rules('txt_major_name', '담당자', 'required');
		$this -> form_validation -> set_rules('txt_tel', '전화번호', 'required');
		$this -> form_validation -> set_rules('txt_tel2', '전화번호', 'required');
		$this -> form_validation -> set_rules('txt_tel3', '전화번호', 'required');
		$this -> form_validation -> set_rules('cbo_major_mobile', '휴대폰', 'required');
		$this -> form_validation -> set_rules('txt_major_mobile2', '휴대폰', 'required');
		$this -> form_validation -> set_rules('txt_major_mobile3', '휴대폰', 'required');
		$this -> form_validation -> set_rules('txt_email_id', '이메일', 'required');
		$this -> form_validation -> set_rules('txt_email_domain', '이메일', 'required');

		if ($this -> form_validation -> run() == TRUE)
		{
			//폼 검증이 성공했을 경우.
			if ($_POST)
			{
				//회원가입 POST 전송 시
				$id = $this -> input ->post('txt_id', TRUE);
				$pw = $this -> input ->post('txt_pw', TRUE);
				$auth_code = "1" ;    //권한코드
				$president_name = $this -> input ->post('txt_president_name', TRUE);
				$title = $this -> input ->post('txt_title', TRUE);
				$reg_no = $this -> input ->post('txt_reg_no', TRUE);
				$reg_no2 = $this -> input ->post('txt_reg_no2', TRUE);
				$reg_no3 = $this -> input ->post('txt_reg_no3', TRUE);
				$biz_type = $this -> input ->post('txt_biz_type', TRUE);
				$biz_item = $this -> input ->post('txt_biz_item', TRUE);
				$zip_code = $this -> input ->post('txt_zip_code', TRUE);
				$zip_code2 = $this -> input ->post('txt_zip_code2', TRUE);
				$address = $this -> input ->post('txt_address', TRUE);
				$addr_detail = $this -> input ->post('txt_addr_detail', TRUE);
				$tel = $this -> input ->post('txt_tel', TRUE);
				$tel2 = $this -> input ->post('txt_tel2', TRUE);
				$tel3 = $this -> input ->post('txt_tel3', TRUE);
				$fax = $this -> input ->post('txt_fax', TRUE);
				$fax2 = $this -> input ->post('txt_fax2', TRUE);
				$fax3 = $this -> input ->post('txt_fax3', TRUE);
				$major_name = $this -> input ->post('txt_major_name', TRUE);
				$major_mobile = $this -> input ->post('cbo_major_mobile', TRUE);
				$major_mobile2 = $this -> input ->post('txt_major_mobile2', TRUE);
				$major_mobile3 = $this -> input ->post('txt_major_mobile3', TRUE);
				$email_id = $this -> input ->post('txt_email_id', TRUE);
				$email_domain = $this -> input ->post('cbo_email_domain', TRUE);
				$homepage = $this -> input ->post('txt_homepage', TRUE);
				//$ = $this -> input ->post('txt_', TRUE);

				$this -> member_m -> insert_member($id, $pw, $auth_code, $president_name, $title, $reg_no, $reg_no2, $reg_no3
																				, $biz_type, $biz_item, $zip_code, $zip_code2 , $address , $addr_detail, $tel , $tel2 , $tel3 
																				, $fax , $fax2 , $fax3 , $major_name , $major_mobile, $major_mobile2 , $major_mobile3 
																			 	, $email_id, $email_domain, $homepage );
				alert('회원가입이 정상적으로 이루어졌습니다. 로그인 하여 주십시요.', LOCAL_PATH .'/index.php/auth/');
					//redirect('index.php/auth/');
				exit;
			}
			else
			{
				//쓰기 폼 view 호출
				$this -> load -> view('member/write_v', $data);
			}
		}
		else
		{
			//폼 검증이 실패했을 때 보여줄 페이지.
			$this -> load ->view('member/write_v', $data);
		}
	}


		/**
		*파일업로드
		*
	*/
	function upload_file()
	{
		if (@$this ->session ->userdata['logged_in'] == TRUE)
		{
			//폼검증 라이브러리
			$this -> load -> library('form_validation');
			//폼검증 필드와 규칙사전정의
			$this -> form_validation -> set_rules('', '제목', 'required');
			$this -> form_validation -> set_rules('', '내용', 'required');

			if ($this -> form_validation ->run() ==FALSE)
			{
				$this -> load -> view('board/view_room_v', $data);		
			}
			else
			{
				//upload설정
				$config = array(
					'upload_path' => 'uploads/',
					'allowed_types' => 'gif|jpg|png',
					'encrypt_name' => TRUE,
					'max_size' => '1000'
					);

				$this -> load -> library('upload', $config);
			}			
		}
		else
		{
			alert('로그인 후 작성가능합니다.', LOCAL_PATH .'/index.php/auth');
			// echo "<script>alert('로그인 후 작성가능합니다.');</script>";
			// redirect('/index.php/auth', 'refresh'); 
			exit;
		}
	}



// 	function modify()
// 	{
// 		echo '<meta http-equiv="Content-Type" content="text/html"; charset=utf-8" />';

// 		if($_POST)
// 		{
// 			//글 수정 POST 전송 시
// 			//주소 중에서 page 세그먼트가 있는지 검사하기 위해 주소를 배열로 변환
// 			$uri_array = $this ->segment_explode($this -> uri -> uri_string());
// // echo $uri_array;
// // echo exit;
// 			if(in_array('page', $uri_array))
// 			{
// 				$pages = urldecode($this -> url_explode ());
// 			}
// 			else
// 			{
// 				$pages = 1;
// 			}

// 			if (!$this -> input -> post('txt_title', TRUE) AND !$this -> input -> post('txt_president_name', TRUE))
// 			{
// 				//상호와 대표자명이 없을 경우, 프로그램단에서 한번 더 체크
// 				alert('비정상적인 접근입니다.', '' .$this ->uri -> segment(3) .'/page/' .$pages);
// 				exit;
// 			}

// 			$modify_data = array(
// 					// 'table' => $this -> uri -> segment(3),			//회원 테이블명(MEMBER)
// 					'table' => 'MEMBER_DETAIL'					//회원 테이블명(MEMBER)
// 					// , 'id' => $this -> session -> userdata('id')		//ID(MEMBER)
// 					// , 'president_name' => $this -> input ->post('txt_president_name', TRUE)
// 					// , 'title' => $this -> input ->post('txt_title', TRUE)
// 					// , 'reg_no' => $this -> input ->post('txt_reg_no', TRUE)
// 					// , 'reg_no2' => $this -> input ->post('txt_reg_no2', TRUE)
// 					// , 'reg_no3' => $this -> input ->post('txt_reg_no3', TRUE)
// 					// , 'biz_type' => $this -> input ->post('txt_biz_type', TRUE)
// 					// , 'biz_item' => $this -> input ->post('txt_biz_item', TRUE)
// 					// , 'zip_code' => $this -> input ->post('txt_zip_code', TRUE)
// 					// , 'zip_code2' => $this -> input ->post('txt_zip_code2', TRUE)
// 					// , 'address' => $this -> input ->post('txt_address', TRUE)
// 					// , 'addr_detail' => $this -> input ->post('txt_addr_detail', TRUE)
// 					// , 'tel' => $this -> input ->post('txt_tel', TRUE)
// 					// , 'tel2' => $this -> input ->post('txt_tel2', TRUE)
// 					// , 'tel3' => $this -> input ->post('txt_tel3', TRUE)
// 					// , 'fax' => $this -> input ->post('txt_fax', TRUE)
// 					// , 'fax2' => $this -> input ->post('txt_fax2', TRUE)
// 					// , 'fax3' => $this -> input ->post('txt_fax3', TRUE)
// 					// , 'major_name' => $this -> input ->post('txt_major_name', TRUE)
// 					// , 'major_mobile' => $this -> input ->post('cbo_major_mobile', TRUE)
// 					// , 'major_mobile2' => $this -> input ->post('txt_major_mobile2', TRUE)
// 					// , 'major_mobile3' => $this -> input ->post('txt_major_mobile3', TRUE)
// 					// , 'email_id' => $this -> input ->post('txt_email_id', TRUE)
// 					// , 'email_domain' => $this -> input ->post('cbo_email_domain', TRUE)
// 					// , 'homepage' => $this -> input ->post('txt_homepage', TRUE)
// 				);
			
// 			$result = $this -> member_m ->modify_member($modify_data);

// 			if ($result)
// 			{
// 				//정보수정 성공 시 예약목록으로
// 				alert('수정되었습니다.', '/member/lists/' .$this ->uri ->segment(3) .'/page/' .$pages);
// 				exit;
// 			}
// 			else
// 			{
// 				//정보수정 실패 시 수정페이지(modify_m)로
// 				alert('다시 수정해 주세요.', '/member/view/'  .$this ->uri ->segment(3) .'/id/' .$this ->uri ->segment(5)  .'/page/' .$pages);
// 				exit;			
// 			}
// 		}
// 		else
// 		{
// 			//회원정보 가져오기
// 			//$data[views] = $this -> member_m ->get_view('MEMBER', $this -> session -> userdata('id'));

// 			//수정 폼 view 호출
// 			$this -> load -> view('member/view_v', $data);
// 		}
// 	}

	/**
		*url 중 키값을 구분하여 값을 가져오도록
		*
		*@param Array $url : segmemt_explode 한 url 값
		*@param String $key : 가져오려는 값의 key
		*@return String $url[$k] : 리턴값
	*/
		function url_explode($url, $key)
		{

			$cnt = count($url);
			for ($i = 0; $cnt > $i; $i++)
			{
				if($url[$i] == $key)
				{
					$k = $i + 1;
					return $url[$k];
				}
			}
		}
		/**
			* HTTP의 URL을 "/"를 Deleimiter로 사용하여 배열로 바꿔 리턴한다.
			*
			*@param string 대상이 되는 문자열
			*@return string[]
		*/
			function segment_explode($seg)
			{
//echo $seg ."</br>";
				//세그먼트 앞뒤 '/' 제거 후 uri를 배열로 반환
				$len = strlen($seg);
				if (substr($seg, 0, 1) == '/')
				{
					$seg = substr($seg, 1, $len);
				}

				$len = strlen($seg);
				if (substr($seg, -1) == '/')
				{
					$seg = substr($seg, 0, $len - 1);
				}
				$seg_exp = explode("/", $seg);
				return $seg_exp;
			}

}
