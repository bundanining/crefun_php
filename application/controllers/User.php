<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {
	// 회원가입 라우팅
	public function join()
	{
		$this->load->view('join');
	}

	// 로그인페이지 라우팅
  	public function index()
  	{
    		$this->load->view('login');
  	}

	// 로그인 체크 라우팅
	public function check()
	{
		$this->load->view('check');
	}
	public function account()
	{
		$this->load->view('account');
	}
}
?>