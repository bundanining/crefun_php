<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Board_m extends CI_Model {
    function __construct() {
        parent::__construct();
        $this->load->helper('url');
    }

    function get_list($start,$limit) {
        //$sql = "SELECT `id`, `title`, `hit`, `writer`, `date` FROM board ORDER BY id DESC";
        $sql = "SELECT board.id, board.title, board.hit, user_data.user_name, board.date FROM board
                    INNER JOIN user_data ON board.writer=user_data.user_id limit $start, $limit";
        $query = $this -> db -> query($sql);

        return $query;
    }
    function get_all(){
      $sql="SELECT `id` FROM board";
      $res= $this->db->query($sql);
      return $res->num_rows();
    }
    function update_hits($id) {
        //조회수 증가 업데이트 구문
        $sql = "UPDATE board SET hit = hit + 1 WHERE id='$id'";
        $this->db->query($sql);
    }
    function load_data($id) {
        //선택한 글내용 가져오기
        $sql = "SELECT * FROM board WHERE id = '$id'";
        $query = $this->db->query($sql);
        return $query->row();
    }
    //게시글 데이터 입력
    function insert_contents($input_data) {
        //데이터 입력 쿼리
        $sql = "INSERT INTO board (`title`,`content`,`writer`) VALUES ('".$input_data['title']."','".$input_data['content']."','".$input_data['writer']."')";

        $res = array();
        $res['result'] = $this->db->query($sql);
        $res['id']=$this->db->insert_id();
        return $res;
    }
    function insert_file($data) {
        $sql = "INSERT INTO upload_file (`format`,`filename`,`size`,`path`,`post_id`) VALUES ('".$data['file_type']."','".$data['file_name']."','".$data['file_size']."','".$data['full_path']."','".$data['post_id']."')";

        $this->db->query($sql);

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
    function delete($id) {
        $sql = "DELETE FROM board WHERE id='$id'";
        $res = $this->db->query($sql);
        $sql2 = "DELETE FROM upload_file WHERE post_id ='$id'";
        $res2 = $this->db->query($sql2);
        if($res && $res2){
          return true;
        } else {
          return false;
        }
    }

}
?>
