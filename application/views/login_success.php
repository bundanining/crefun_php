<?php
    if (@$this -> session -> userdata('logged_in') == TRUE) {
?>
<?php echo $this -> session -> userdata('user_name');?> 님 환영합니다. <a href="logout" class="btn">로그아웃</a>
<?php
    } else {
?>
<a href="index.php" class="btn btn-primary"> 로그인 </a>
<?php
    }
?>
