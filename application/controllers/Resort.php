<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Resort extends CI_Controller {

	function __construct()
	{
		parent::__construct();
			$this->load->database();
			$this->load->helper('url');
			$this->load->model('resort_m');
			$this->load->model('common_m');
	}
	/**
		* 주소에서 메서드가 생략되었을 때 실행되는 기본 메서드
	**/
	public function index()
	{
		if ($this ->session ->userdata['auth_code'] != '0')
		{
				alert('권한이 없습니다. 관리자 권한으로 로그인하십시요.', LOCAL_PATH .'/index.php/auth');
		}
		else
		{
		//$this->load->view('member/list_v');	
			$this->lists();		
		}
	}


	// 사이트에 헤더, 푸터가 자동으로 추가된다.
	public function _remap($method)
	{
		$header_name ="";
//관리자와 사용자 헤더 메뉴 인크루드
		if (@$this ->session ->userdata['auth_code'] == '0')
		{
			$header_name  = "admin_header_v";
		}
		else
		{
			$header_name  = "front_header_v";
		}

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
		$config['base_url'] = LOCAL_PATH.'/index.php/Resort/lists/RESORT/' .$page_url .'/page/';		//페이징 주소
		$config['total_rows'] = $this->resort_m->get_list($this->uri->segment(3), 'count', '', '', $search_word);		//게시물의 전체개수
		$config['per_page'] = 5;										//한페이지에 표시할 게시물 수
		$config['uri_segment'] = $uri_segment;		//페이지 번호가 위치한 세그먼트 


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
		$data['list'] =$this->resort_m->get_list($this->uri->segment(3), '', $start, $limit, $search_word);
		//print_r ($data);
		$this->load->view('resort/list_v', $data);

	}

	/**
	*리조트 보기
	*/
	function view()
	{
		$data['nation'] =$this->common_m->get_common_code_list(4);			//국가 공통코드		
		$data['grade'] =$this->common_m->get_common_code_list(1);			//등급 공통코드
		$data['room'] =$this->common_m->get_common_code_list(7);			//객실타입 공통코드
		$data['meal'] =$this->common_m->get_common_code_list(2);			//식사타입 공통코드
		$data['vehicle'] =$this->common_m->get_common_code_list(3);		//이동수단 공통코드
	

		
		//게시판 이름과 리조트cn에 해당하는 data 가져오기
		$data['views'] = $this->resort_m->get_view($this->uri->segment(2), $this->uri->segment(3));
		//$data['views']->grade ;    
		//$data['views']->cGrade[$data['views']->grade['1']] = "selected";

		//view 호출
		$this->load->view('resort/view_v', $data);
	}

	function write()
	{
		if ($_POST)
		{
			//회원가입 POST 전송 시
			$local_code_cn = $this -> input ->post('cbo_area', TRUE);
			$grade_code_cn = $this -> input ->post('cbo_room_grade', TRUE);
			$title_kr = $this -> input ->post('txt_title_kr', TRUE);
			$title_us = $this -> input ->post('txt_title_us', TRUE);
			$address = $this -> input ->post('txt_address', TRUE);
			$tel = $this -> input ->post('txt_tel', TRUE);
			$fax = $this -> input ->post('txt_fax', TRUE);
			$room_code_cns = $this -> input ->post('hdn_room_code_cns', TRUE);
			$meal_code_cns = $this -> input ->post('hdn_meal_code_cns', TRUE);
			$vehicle_code_cns = $this -> input ->post('hdn_vehicle_code_cns', TRUE);
			$special = $this -> input ->post('txt_special', TRUE);
			$honeymoon_privilege = $this -> input ->post('txt_honeymoon_privilege', TRUE);
			$inclusion = $this -> input ->post('txt_inclusion', TRUE);
			$exclusion = $this -> input ->post('txt_exclusion', TRUE);

			$this -> resort_m -> insert_resort($local_code_cn, $grade_code_cn, $title_kr, $title_us
																			, $address, $tel, $fax, $room_code_cns, $meal_code_cns
																			, $vehicle_code_cns, $special, $honeymoon_privilege
																		 	, $inclusion, $exclusion );
			redirect('index.php/resort/lists/');

			exit;
		}
		else
		{
			$data['nation'] =$this->common_m->get_common_code_list(4);			//국가 공통코드		
			$data['grade'] =$this->common_m->get_common_code_list(1);			//등급 공통코드
			$data['room'] =$this->common_m->get_common_code_list(7);			//객실타입 공통코드
			$data['meal'] =$this->common_m->get_common_code_list(2);			//식사타입 공통코드
			$data['vehicle'] =$this->common_m->get_common_code_list(3);		//이동수단 공통코드

			//쓰기 폼 view 호출
			$this -> load -> view('resort/write_v', $data);
		}
	}

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
