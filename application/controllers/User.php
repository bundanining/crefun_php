<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {
	function __construct() {
			parent::__construct();
			$this->load->database();
			$this->load->helper('url');
		}
	// index 페이지 라우팅
	public function index()
	{
		$this->load->view('login');
	}
	//로그인 후 임시페이지
	public function main()
	{
		redirect('board', 'refresh');
	}
	// 아이디 중복 검사
	public function check_page() {
		$this->load->view('check_page');
	}
	public function new_check() {
		$this->load->model('user_m');
		$id = $this->input->post('user_id');
		if(!$this->user_m->check_user($id)) {
			echo "true";
		} else {
			echo "false";
		}
	}
	// 회원가입 라우팅
	public function join()
	{
		$this->load->view('join');
	}
	public function logout() {
		$this->load->view('logout');
		$this->session->sess_destroy();
	}
	// 로그인 체크 라우팅
	public function check()
	{
		$this->load->model('user_m');
		$auth_data = array(
			'user_id' => $this -> input -> post('user_id'),
			'user_pw' => $this -> input -> post('user_pw')
		);
		$res = $this->user_m->get_result($auth_data);
		if($res) {
			$newdata = array(
					 'user_name'  => $res->user_name,
					 'user_id'     => $res->user_id,
					 'logged_in' => TRUE
			);
			$this->session->set_userdata($newdata);
			echo true;
		}
		else {
			echo false;
		}
	}
	public function account()
	{
		$this->load->model('user_m');
		$input_data = array(
			'name' => $this->input->post('user_name'),
			'id' => $this->input->post('user_id'),
			'pw' => $this->input->post('user_pw')
		);
		$res = $this->user_m->input_user($input_data);
		if($res == true){
			$this->load->view('account_success');
		}
		else
		{
			$this->load->view('account_fail');
		}
	}
}
?>
