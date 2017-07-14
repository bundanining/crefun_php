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
    function get_search($start,$limit,$dataSet)
    {

        $sub_sql="SELECT board.id, board.title, board.hit, user_data.user_name, board.date FROM board INNER JOIN user_data ON board.writer=user_data.user_id";
        $sub_sql2=" LIMIT ".$start.",".$limit;

        if(!strcmp($dataSet['condition'],'title') || !strcmp($dataSet['condition'],'content')){
          $condition = " WHERE ".$dataSet['condition']." regexp '".$dataSet['data']."' ";
        } else if(!strcmp($dataSet['condition'],'writer')) {
		  $condition = " WHERE user_data.user_name = '".$dataSet['data']."'";
		}
        
		if(!strcmp($dataSet['fileChk'],'check')){
			$tmp=" AND board.u_file is not NULL";
			$sql = $sub_sql.$condition.$tmp.$sub_sql2;
		} else {
          $sql = $sub_sql.$condition.$sub_sql2;
        }
        return $this->db->query($sql);
    }
    function get_search_all($dataSet){
        $sql = "SELECT board.id, board.title, board.hit, user_data.user_name, board.date FROM board
                  INNER JOIN user_data ON board.writer=user_data.user_id WHERE ".$dataSet['condition']." = '".$dataSet['data']."'";
        return $this->db->query($sql);
    }
    function get_all() {
      $sql="SELECT `id` FROM board";
      $res= $this->db->query($sql);
      return $res->num_rows();
    }
    function update_hits($id) {
        //조회수 증가 업데이트 구문
        $sql = "UPDATE board SET hit = hit + 1 WHERE id='$id'";
        $this->db->query($sql);
    }
    function update($dataSet){
        // 게시글 업데이트
        $sql = "UPDATE board SET title = '".$dataSet['title']."', content = '".$dataSet['content']."' WHERE id='".$dataSet['id']."' ";
        if($this->db->query($sql))
          return true;
        else
          return false;
    }
    function load_data($id) {
        // 20170712 LEFT 조인으로 교체할 것.
        // 선택한 글내용 가져오기
        // $sql0 = "SELECT * FROM upload_file WHERE post_id = '$id'";
        // $tmp = $this->db->query($sql0);
        // if($tmp->num_rows() > 0){
        //     $sql = "SELECT board.id, board.title, board.content, upload_file.path FROM board LEFT JOIN upload_file ON board.id=upload_file.post_id WHERE board.id='$id'";
        // } else {
        //     $sql = "SELECT * FROM board WHERE id = '$id'";
        // }

        //$sql = "SELECT board.id, board.title, board.content, upload_file.path FROM board LEFT JOIN upload_file ON board.id=upload_file.post_id WHERE board.id='$id'";
        $sql = "SELECT `id`,`title`,`content`,`u_file` FROM board WHERE id='$id'";
        $query = $this->db->query($sql);
        return $query->row();
    }
    //게시글 데이터 입력
    function insert_contents($input_data,$tmp) {

        //데이터 입력 쿼리
        if($tmp == 0){
        $sql = "INSERT INTO board (`title`,`content`,`writer`) VALUES ('".$input_data['title']."','".$input_data['content']."','".$input_data['writer']."')";
        $res = array();
        $res['result'] = $this->db->query($sql);
        $res['id']=$this->db->insert_id();
        return $res;
        }
        else {
          $path = $input_data['id']."/".$input_data['client_name'];
          $id = $input_data['id'];
          $sql = "UPDATE board SET u_file='$path' WHERE id='$id'";
          $this->db->query($sql);
          return true;
        }
    }
    function insert_file($data) {
        $path = $data['post_id']."/".$data['client_name'];
        $sql = "INSERT INTO upload_file (`format`,`filename`,`size`,`path`,`post_id`) VALUES ('".$data['file_type']."','".$data['file_name']."','".$data['file_size']."','".$path."','".$data['post_id']."')";

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
