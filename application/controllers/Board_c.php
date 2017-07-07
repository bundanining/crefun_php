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
        if (!$currentSession->userdata['logged_in']){
          $this->load->view('p_login');
        }
        else {
          $this->load->view('b_write');
        }

    }
    public function list() {
        $res['list'] = $this->board_m->get_list();
        $this->load->view('b_list',$res);
    }
    public function detail($id){
      $currentSession = $this -> session;
      // user_id 정보가 없는 경우는 접속 안한 것으로 간주함
      if (!$currentSession->userdata['logged_in']){
        $this->load->view('p_login');
        return;
      }
      else {
        $res['contents'] = $this->board_m->get_detail($id);
        $this->load->view('b_detail',$res);
      }

    }
  }
  ?>
