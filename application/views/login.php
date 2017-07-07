<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>PAGE</title>

<!-- 합쳐지고 최소화된 최신 CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">

<!-- 부가적인 테마 -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap-theme.min.css">

<!-- 합쳐지고 최소화된 최신 자바스크립트 -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>

</head>
<body>
  <div class="container">
    <div class="col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-md-4 col-md-offset-4">
      <div class="login-panel panel panel-default">
        <div class="panel-heading">LOGIN</div>
        <div class="panel-body">
          <form id="form1" role="form" action="index.php/user/main" method="post" onsubmit="return false">
            <fieldset>
              <div class="form-group">
                <input class="form-control" placeholder="USER ID" id="user_id" type="text" autofocus="" value="">
              </div>
              <div class="form-group">
                <input class="form-control" placeholder="PASSWORD" id="user_pw" type="password" value="">
              </div>
              <button id="submit" class="btn btn-primary">Login</button>
            </fieldset>
          </form>
          <a href="index.php/user/join">회원가입</a>
          <a href="index.php/user/main">게시판으로 가기</a>
        </div>
        <div id="message"></div>
      </div>
    </div><!-- /.col-->
  </div><!-- /.row -->

<?php $this->load->view('script'); ?>
<script type="text/javascript">
    $(document).ready(function() {
          $('#submit').click(function(){
              //빈칸 있는지 확인
              if($('#user_id').val() == "") {
                alert("아이디를 입력하세요.");
                $('#user_id').focus();
              } else if($('#user_pw').val() == "") {
                alert("패스워드를 입력하세요.");
                $('#user_pw').focus();
              }
            });
          });
    $('#submit').click(function(){
      $.ajax({
        url: 'index.php/user/check',
        type: 'POST',
        data: {'user_id': $('#user_id').val(),'user_pw': $('user_pw').val()},
        dataType: 'html',
        success: function(data){
          if(data) {
            $("#form1").slideUp('slow');
            alert(data);
            alert('로그인되었습니다.','index.php/user/main');
          } else {
            //alert(result);
            $("#message").html("<p style='color:red'>아이디 또는 비밀번호가 잘못되었습니다.</p>");
          }
          // alert(data); // 결과 텍스트를 경고창으로 보여준다.
        }
      });
    });
</script>
</body>

</html>
