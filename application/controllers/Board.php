<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Board extends CI_Controller {
	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	function __construct()
	{
		parent::__construct();
			$this-> load ->database();
			$this-> load ->model('board_m');
			$this-> load ->model('common_m');
			$this -> load -> helper('alert');
	}
	/**
		* 주소에서 메서드가 생략되었을 때 실행되는 기본 메서드
	**/
	public function index()
	{
		//$this->load->view('board_v');
		$this->lists();
	}

	// 사이트에 헤더, 푸터가 자동으로 추가된다.
	public function _remap($method)
	{
		$this -> load -> helper('url');

		$header_name ="";
	//관리자와 사용자 헤더 메뉴 인크루드
	if (@$this ->session ->userdata['logged_in'] == TRUE)
	{
		if ($this ->session ->userdata['auth_code'] == '0')
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
		alert("로그인 후 작성가능합니다.", LOCAL_PATH."/index.php/auth");
		// echo "<script>alert('로그인 후 작성가능합니다.');</script>";
		// redirect('/index.php/auth'); 
		// $this -> load -> view('auth/login_v');
		exit;
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
		$board_type = $search_word = $page_url = '';
		$uri_segment = 5;

		//주소 중에서 txt_keyword(검색어, txt_keyword) 세그먼트가 있는지 검사하기 위해 주소를 배열로 변환.
		$uri_array = $this -> segment_explode($this -> uri ->uri_string());

		if ( in_array('txt_keyword', $uri_array)) 
		{
			//주소에 검색어가 있을 경우의 처리. 즉 검색 시
			$search_word = urldecode($this -> url_explode($uri_array, 'txt_keyword'));
			$page_url ='/txt_keyword/' .$search_word;
		}

		if ( in_array('b_type', $uri_array)) 
		{
			//주소에 게시판구분이 있을 경우의 처리. 
			$board_type = urldecode($this -> url_explode($uri_array, 'b_type'));
			$page_url ='/b_type/' .$board_type;
			$data['board_type'] = $board_type;
// echo $board_type ;
			switch ($board_type) {
				case '546':		//공지사항
					$data['view_type'] = "view_notice";
					break;
				case '547':		//자료실
					$data['view_type'] = "view_room";
					break;				
				default:
					$data['view_type'] = "view_notice";
					break;
			}

// echo $data['view_type'] ;
		}
			//페이지네이션용 주소
		if ( in_array('txt_keyword', $uri_array) AND in_array('b_type', $uri_array)) 
			{
				$uri_segment = 9;
			} 
		else if (( in_array('txt_keyword', $uri_array) OR in_array('b_type', $uri_array))) 
		{
				$uri_segment = 7;
		}
		else
		{
			$uri_segment = 5;
			$data['view_type'] = "view_notice";
			$data['board_type'] = "";
		}

		//페이지네이션 라이브러리 로딩 추가
		$this->load->library('pagination');

		//페이지네이션 설정
		$config['base_url'] = '/index.php/board/lists/BOARD/' .$page_url .'/page/';		//페이징 주소
		$config['total_rows'] = $this->board_m->get_list($this->uri->segment(3), 'count', '', '', $search_word, $board_type);		//게시물의 전체개수
		$config['per_page'] = 5;										//한페이지에 표시할 게시물 수
		$config['uri_segment'] = $uri_segment;		//페이지 번호가 위치한 세그먼트 


		$this ->pagination->initialize($config);											//페이지네이션 초기화
		$data['pagination'] = $this->pagination->create_links();		//페이징 링크를 생성하여 view에서 사용할 변수에 할당
		$page = $this->uri->segment($uri_segment,1);

		if ($page > 1)
		{
			$start =(($page/$config['per_page'])) * $config['per_page'];
		}
		else
		{
			$start = ($page-1) * $config['per_page'];
		}
		$limit = $config['per_page'];

		$data['btype'] =$this->common_m->get_common_code_list(8);		//게시판 구분
		$data['list'] =$this->board_m->get_list($this->uri->segment(3), '', $start, $limit, $search_word, $board_type);

// print_r(	$uri_array) ."</br>";

		$this->load->view('board/list_v', $data);
	}

	public function write($type)
	{
		if ($type=='notice')
		{
			$code_cn = '546';
			$target_function = 'write_notice';
		} 
		else
		{
			$code_cn = '547';
			$target_function = 'write_room';
		}

		$this -> load -> library('form_validation');				//폼 검증 라이브러리 로드

		//폼 검증할 필드와 규칙 사전 정의
		$this -> form_validation -> set_rules('txt_subject', '제목', 'required');
		$this -> form_validation -> set_rules('txt_contents', '내용', 'required');

		if ($this -> form_validation -> run() == TRUE)
		{
			//폼 검증이 성공했을 경우.
			if ($_POST)
			{
				$data['table'] = 'BOARD';
				$data['member_id'] = $this -> session -> userdata('id');		//ID(MEMBER)
				$data['type_code_cn'] = $code_cn;
				$data['subject'] = $this -> input ->post('txt_subject', TRUE);
				$data['contents'] = $this -> input ->post('txt_contents', TRUE);

				//게시판 POST 전송 시
				$result = $this -> board_m -> insert_board($data);

				if ($this -> upload -> do_upload('file_upload'))
				{
					$this ->  upload_file($result);
				}		
// 				else				
// 				{
// // $data['error'] = $this -> upload ->display_errors();
// // echo 	$config ['upload_path'];				
// 					echo "<script>alert('업로드에 실패 했습니다. ".$this->upload->display_errors('','')."')</script>";
// 					exit;
// 					$this -> load ->view('board/'.$target_function.'_v', @$data);
// 				}

					if ($result)
					{
						//게시판등록 성공 시 목록으로
						alert('게시물이 등록되었습니다.', LOCAL_PATH. '/index.php/board/lists/BOARD/b_type/'.$code_cn.'/');
					}
					else
					{
						//게시판등록 실패 시 입력페이지()로
						alert('게시물 등록이 실패하였습니다. 다시 등록해 주세요.', LOCAL_PATH. '/index.php/board/'.$target_function.'/');	
					}
					exit;						
				}
			else
			{
			//쓰기 폼 view 호출
			$this -> load -> view('board/'.$target_function.'_v', @$data);		
			}
		}
		else
		{
			//폼 검증이 실패했을 때 보여줄 페이지.
			$this -> load ->view('board/'.$target_function.'_v', @$data);
		}
	}

	function write_notice()
	{
		$this -> write('notice');
	}

	function write_room()
	{
		$this -> write('room');
	}

	function view_notice()
	{
		$data['views'] = $this->board_m->get_view('BOARD', $this->uri->segment(3));		
		$this -> load -> view('board/view_notice_v', $data);		
	}

	function view_room()
	{
		$this->load->helper('download');

		$data['views'] = $this->board_m->get_view('BOARD', $this->uri->segment(3));				
		$this -> load -> view('board/view_room_v', $data);		
	}


	function upload_receive_from_ck(){
		//upload설정
		$config = array(
			'upload_path' => UPLOAD_ROOT.'/ckeditor/',					//업로드 파일경로
			'allowed_types' => 'gif|jpg|png',			//허용 확장자
			'encrypt_name' => TRUE,
			'max_size' => '1000'									//허용파일사이즈
			// 'max_width' => '1000'							//허용파일 너비
			// 'max_height' => '1000'						//허용파일 높이
		);

        $this->load->library('upload', $config);

        if ( ! $this->upload->do_upload("upload"))
        {
            echo "<script>alert('업로드에 실패 했습니다. ".$this->upload->display_errors('','')."')</script>";
        }   
      else
      {
          $CKEditorFuncNum = $this->input->get('CKEditorFuncNum');

          $data = $this->upload->data();            
          $filename = $data['file_name'];
          
          $url = '/static/user/'.$filename;

          echo "<script type='text/javascript'>window.parent.CKEDITOR.tools.callFunction('".$CKEditorFuncNum."', '".$url."', '전송에 성공 했습니다')</script>";         
      }
  }

	/**
		*파일업로드
		*
	*/
	function upload_file($ref_cn)
	{
		//upload설정
		$config = array(
			'upload_path' => './upload/',					
			'allowed_types' => 'gif|jpg|png|pptx|ppt|xls|xlsx',
			'encrypt_name' => TRUE,
			'max_size' => '3000'
		);

		$this -> load -> library('upload', $config);

		$upload_data = $this -> upload -> data();
		//이미지 리사이즈
		if ($upload_data['image_width'] > 300) 
		{
			$config['image_library'] = 'gd2';
			$config['source_image'] = $upload_data['full_path'];
			$config['create_thumb'] = TRUE;
			$config['matain_ratio'] = TRUE;
			$config['width'] = 300;
			$config['height'] = 300;

			$this ->load ->library('image_lib', $config);
		}
		$upload_data['ref_cn'] = $ref_cn;
		$result = $this -> board_m -> insert_attach_file($upload_data);
	}

	// /**
	// 	*파일업로드 수정
	// 	*
	// */
	// function modify_file()
	// {

	// }		
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
