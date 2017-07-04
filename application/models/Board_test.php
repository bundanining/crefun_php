<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * 공통 게시판 모델
 */

class Board_test extends CI_Model {
    function __construct() {
        parent::__construct();
    }

    function get_list($table = 'login') {
        $sql = "SELECT * FROM ".$table." ORDER BY board_id DESC";
        $query = $this -> db -> query($sql);
        $result = $query -> result();
        // $result = $query->result_array();

        return $result;
    }

}
