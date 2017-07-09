<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Board_m extends CI_Model {
    function __construct() {
        parent::__construct();
        $this->load->helper('url');
    }

    function get_list() {
        //$sql = "SELECT `id`, `title`, `hit`, `writer`, `date` FROM board ORDER BY id DESC";
        $sql = "SELECT board.id, board.title, board.hit, user_data.user_name, board.date FROM board
                    INNER JOIN user_data ON board.writer=user_data.user_id";
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
    //게시글 데이터 입력
    function insert_contents($input_data) {
        //데이터 입력 쿼리
        $sql = "INSERT INTO board (`title`,`content`,`writer`) VALUES ('".$input_data['title']."','".$input_data['content']."','".$input_data['writer']."')";
        $res = $this->db->query($sql);
        return $res;
    }
    function id_check($dataSet) {
        $uid = $dataSet['u_id'];
        $id = $dataSet['id'];
        $sql = "SELECT `writer` FROM board WHERE id='$id'";
        $res = $this->db->query($sql);
        $data = $res->row_array();
        if($res) {
          if($uid == $data['writer']){
            return true;
          } else {
            return false;
          }
        } else {
          return false;
        }
    }
	function update($dataSet){
		$sql = "UPDATE board set title='".$dataset['title']."', content='".$dataSet['content']."' WHERE id='".$dataSet['id']."'";
		$res=$this->db->query($sql);
		if($res)
			return true;
		else
			return false;
	}
	
    function delete($id) {
        $sql = "delete FROM board WHERE id='$id'";
        $res = $this->db->query($sql);
        if($res){
          return true;
        } else {
          return false;
        }
    }

}
?>
