<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class User_model extends CI_Model {
    function __construct() {
        parent::__construct();
        $this->load->helper('url');
    }

    function get_result($auth) {
        $sql = "SELECT `user_id`, `user_name`, `user_pw` FROM user_data WHERE `user_id` ='" .$auth['user_id']. "' ";
        $query = $this -> db -> query($sql);
        $row = $query->row_array();
        if(password_verify($auth['user_pw'], $row['user_pw']))
        {
            return $query -> row();
        }
        else
        {
            return false;
        }
    }
    function check_user($id) {
      $sql = "SELECT `user_id` FROM user_data WHERE `user_id` = '$id'";
      $result = $this -> db -> query($sql);
      if($result->num_rows() > 0)
        return true;
      else
        return false;
    }
    function input_user() {
        $name = $this->input->post('user_name');
        $id = $this->input->post('user_id');
        $pw = $this->input->post('user_pw');
        $hash_pw = password_hash($pw,PASSWORD_DEFAULT);
        if($this->user_model->check_user($id)){
          return false;
        } else {
          $sql = "INSERT INTO user_data (`user_name`, `user_id`, `user_pw`) VALUES('$name','$id','$hash_pw')";
          $this-> db -> query($sql);
          return true;
        }
    }
}
