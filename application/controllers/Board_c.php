<?php
  defined('BASEPATH') OR exit('No direct script access allowed');
require_once 'Upload.php';
class Board_c extends CI_Controller {
	function __construct() {
			parent::__construct();
			$this->load->database();
      $this->load->model('board_m');
      $this->load->helper('url');
      $this->load->helper('form');
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
        $res = $this->board_m->insert_contents($input_data);
        $config = array();
        $config['upload_path'] = '/home/ubuntu/crefun_php/upload';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size']      = '0';
        $config['overwrite']     = FALSE;
        $this->load->library('upload',$config);
        if(!$this->upload->do_upload('userfile')){
          $error = array('error' => $this->upload->display_errors());
          print_r($error['error']);
        } else {
          $data = array(
            'post_id' => $res['id'],
            'file_name' => $this->upload->data('file_name'),
            'file_type' => $this->upload->data('file_type'),
            'full_path' => $this->upload->data('full_path'),
            'file_size' => $this->upload->data('file_size')
        );
          $this->board_m->insert_file($data);
        }
        $flag = false;
        if($res['result'])
          $flag = true;
        $temp['flag'] = $flag;
        $this->load->view('input_success',$temp);
    }
    public function index() {
        //페이지네이션
        if($this -> uri -> segment(2) == NULL){
          $id = 1;
        }else{
          $id = $this -> uri -> segment(2);
        }
        $this->load->library('pagination');
        $query = $this->board_m->get_list($id);
        $count = $this->board_m->get_all();
        //페이지네이션 config
        $config['base_url'] = '/index.php/board';
        $config['total_rows'] = $count;
        $config['per_page'] = 4;
        $config['reuse_query_string'] = FALSE;
        $res = array(
            'list' => $query->result(),
            'pagination' => $this->pagination
        );
        $this->pagination->initialize($config);
        $this->load->view('b_list',$res);
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
    //게시글 수정 메소드
    public function update(){
      $res=$this->board_m->load_data($this->uri->segment(3));
      $dataSet = array(
    		'id' => $this->uri->segment(3),
    		'title' => $res->title,
    		'content' => $res->content
    	);
      $this->load->view('b_update',$dataSet);
    }

    //게시글 삭제 메소드
    public function delete() {
        $dataSet = array(
          'id' => $this->uri->segment(3),
          'u_id' => $this->session->userdata('user_id')
        );
        if($this->board_m->id_check($dataSet)){
          $flag = false;
          $this->board_m->delete($this->uri->segment(3));
          echo "true";
        } else {
          echo "false";
        }
    }
}
?>
