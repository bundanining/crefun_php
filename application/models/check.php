<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class User_check extends CI_Model {
    function __construct() {
        parent::__construct();
    }

    function get_result($table = 'login') {
        $id = $this->input->post('user_id');
        $pw = $this->input->post('user_pw');
        $sql = "SELECT `user_id`, `user_pw` FROM ".$table." WHERE `user_id`=`".$id."` AND `user_pw`= `".$pw."` ";
        $query = $this -> db -> query($sql);
        $result = $query -> result();
        //   if($result!=null)
        //   {
        //       $cookie = array(
        //       'name'   => 'id',
        //       'value'  => $result,
        //       'expire' => '0',
        //       'domain' => 'http://52.79.255.157',
        //       'path'   => '/',
        //       'prefix' => 'myprefix_',
        //       'secure' => TRUE
        //
        //   );
        //
        //   $this->input->set_cookie($cookie);
        // }
        return $result;
    }

}
