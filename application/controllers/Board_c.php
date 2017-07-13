<?php
  defined('BASEPATH') OR exit('No direct script access allowed');
class Board_c extends CI_Controller {
	function __construct() {
			parent::__construct();
			$this->load->database();
      $this->load->model('board_m');
      $this->load->helper('url');
      $this->load->helper('form');
		}
    //게시판 목록 메인
    public function index() {
        $config['per_page'] = 5;
        //페이지네이션 게시글 5개씩 출력
        $start = $this -> uri -> segment(2, 0);
        $limit = $config['per_page'];
        // print_r($start);
        if($start > 0){
          $start = $start * $limit -$limit;
        }
        $count = $this->board_m->get_all();
        $query = $this->board_m->get_list($start,$limit);

        $this->load->library('pagination');

        //페이지네이션 config
        $config['num_links'] = 2; // 쪽선택 몇개씩 보여줄것인지 2이면 1,2,3,4,5까지 보임
         // 한쪽에 표현될 아이템의 갯수
        $config['use_page_numbers'] = TRUE; //URI 새그먼트는 페이징하는 아이템들의 시작 인덱스를 사용함. 실제 페이지 번호를 보여주고 싶다면, TRUE
        $config['base_url'] = '/index.php/board'; //페이지네이션이 보여질 url
        $config['total_rows'] = $count; //전체 행의 개수
        $res = array(
            'list' => $query->result(),
            'pagination' => $this->pagination
        );

        $this->pagination->initialize($config);
        $this->load->view('b_list',$res);
    }
    public function write() {
        $currentSession = $this -> session;
        // user_id 정보가 없는 경우는 접속 안한 것으로 간주함
        if (!$currentSession->userdata['logged_in']) {
          $this->load->view('p_login');
        }
        else {
          $this->load->view('b_write');
        }
    }
    public function insert(){
        $input_data = array(
            'title' => $this -> input -> post('title'),
            'content' => $this -> input -> post('content'),
            'writer' => $this -> session -> userdata('user_id'),
        );
        $res = $this->board_m->insert_contents($input_data,0);
        if(isset($_FILES)) {
          $config = array();
          $config['upload_path'] = '/home/ubuntu/crefun_php/upload/'.$res['id'];
          $config['allowed_types'] = 'gif|jpg|png';
          $config['max_size']      = '0';
          $config['overwrite']     = FALSE;
          $this->load->library('upload',$config);
          //디렉토리 생성
          $path="./upload/".$res['id'];
          mkdir($path);
          if(!$this->upload->do_upload('userfile')){
            $error = array('error' => $this->upload->display_errors());
          } else {
            $data = array(
              'id' => $res['id'],
              'client_name' => $this->upload->data('client_name')
            );
            $this->board_m->insert_contents($data,1);
          }
        }
        $flag = false;
        if($res['result'])
          $flag = true;
        $temp['flag'] = $flag;
        $this->load->view('input_success',$temp);
    }
    public function detail(){
      $currentSession = $this -> session;
      // user_id 정보가 없는 경우는 접속 안한 것으로 간주함
      if (!$currentSession->userdata['logged_in']){
        $this->load->view('p_login');
        return;
      }
      else {
        //url에서 파라미터값 가져옴
        $id = $this -> uri -> segment(3);
        //글 데이터 가져오기
        $this->board_m->update_hits($id);
        $res['contents'] = $this->board_m->load_data($id);
        $this->load->view('b_detail',$res);
      }
    }
    //게시글 수정로드 메소드
    public function update_view(){
      $res=$this->board_m->load_data($this->uri->segment(3));
      $dataSet = array(
    		'id' => $this->uri->segment(3),
    		'title' => $res->title,
    		'content' => $res->content
    	);
      $this->load->view('b_update',$dataSet);
    }
    //게시글 수정 메소드
    public function update_post(){
      $dataSet = array(
    		'id' => $this->uri->segment(3),
    		'title' => $this->input->post('title'),
    		'content' => $this->input->post('content')
    	);
      $res['flag']=$this->board_m->update($dataSet);
      if($res['flag']){
        $this->load->view('input_success',$res);
      }
    }
    //게시글 삭제 메소드
    public function delete() {
        $dataSet = array(
          'id' => $this->uri->segment(3),
          'u_id' => $this->session->userdata('user_id')
        );
        if($this->board_m->id_check($dataSet)){
          $flag = false;
          $id = $this->uri->segment(3);
          $path = './upload/'.$id;
          $this->board_m->delete($id);
          $this->rmdir_all($path);
          echo "true";
        } else {
          echo "false";
        }
    }

    public function search() {
      //페이지네이션 게시글 5개씩 출력
      $start = $this -> uri -> segment(3, 0);
      $config['per_page'] = 5;  // 한쪽에 표현될 아이템의 갯수
      print_r($start);
      //페이지네이션 게시글 5개씩 출력
      $limit = $config['per_page'];
      if($start > 0){
        $start = $start * $limit -$limit;
      }
      $data = array(
        'condition' => $_GET['o'],
        'data' => $_GET['q']
      );
      $query = $this->board_m->get_search($start,$limit,$data);
      $query2 = $this->board_m->get_search_all($data);
      $count = $query2->num_rows();

      $this->load->library('pagination');
      //페이지네이션 config
      $config['num_links'] = 2; // 쪽선택 몇개씩 보여줄것인지 2이면 1,2,3,4,5까지 보임
      $config['use_page_numbers'] = TRUE; //URI 새그먼트는 페이징하는 아이템들의 시작 인덱스를 사용함. 실제 페이지 번호를 보여주고 싶다면, TRUE
      $config['base_url'] = '/index.php/board/search?o='.$data['condition'].'&q='.$data['data']; //페이지네이션이 보여질 url
      $config['total_rows'] = $count; //전체 행의 개수
      $this->pagination->initialize($config);
      $res = array(
          'list' => $query->result(),
          'pagination' => $this->pagination
      );


      $this->load->view('b_list',$res);
    }
    //하위파일포함 디렉토리 삭제 메소드 2017.07.13
    function rmdir_all($dir) {
      if (!file_exists($dir)) {
        return;
      }
      $dhandle = opendir($dir);
      if ($dhandle) {
        while (false !== ($fname = readdir($dhandle))) {
           if (is_dir( "{$dir}/{$fname}" )) {
              if (($fname != '.') && ($fname != '..')) {
                 $this->rmdir_all("$dir/$fname");
              }
           } else {
              unlink("{$dir}/{$fname}");
           }
        }
        closedir($dhandle);
      }
      rmdir($dir);
    }
}
?>
