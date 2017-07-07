<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Board_m extends CI_Model {
    function __construct() {
        parent::__construct();
        $this->load->helper('url');
    }

    function get_list() {
        $sql = "SELECT * FROM board ORDER BY id DESC";
        $query = $this -> db -> query($sql);
        return $query->result();
    }
    function get_detail($id) {
        //조회수 증가 업데이트 구문
        $sql0 = "UPDATE board SET hit = hit + 1 WHERE id='$id'";
        $this->db->query($sql0);

        //선택한 글내용 가져오기
        $sql = "SELECT * FROM board WHERE id = '$id'";
        $query = $this->db->query($sql);
        return $query->row();
    }

}
?>
