<?php
  defined('BASEPATH') OR exit('No direct script access allowed');

class Board_c extends CI_Controller {
	function __construct() {
			parent::__construct();
			$this->load->database();
      $this->load->model('board_m');
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
            'pw' => $this -> input -> post('pw')
        );
        $res = $this->board_m->insert_contents($input_data);
        $flag = false;
        if($res)
          $flag = true;
        $temp['flag'] = $flag;
        $this->load->view('input_success',$temp);
    }
    public function index() {
        $res['list'] = $this->board_m->get_list();
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
        $res['contents'] = $this->board_m->get_detail($id);
        $this->load->view('b_detail',$res);
      }
    }
	//게시글 수정 메소드
	public function update(){
		$dataSet = array(
			'id' => $this->uri->segement(3),
			'title' => $this->input->post('title'),
			'content' => $this->input->post('content')
		);
		$res['flag'] = $this->user_m->update($dataSet);
		$this->load->view('update',$res);
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
