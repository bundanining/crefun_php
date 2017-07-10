<?php $this->load->view('header'); ?>

<body>
  <div class="container">
    <div class="col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-md-4 col-md-offset-4">
      <div class="login-panel panel panel-default">
        <div class="panel-heading">회원가입</div>
        <div class="panel-body">
          <form name="account" role="form" action="account" method="post">
            <fieldset>
  			      <div class="form-group">
                <input class="form-control" placeholder="NAME" id="user_name" name="user_name" type="text" autofocus="" value="">
              </div>
              <div class="input-group">
                <input class="form-control" placeholder="USER ID" id="user_id" name="user_id" type="text" value="">
                <span class="input-group-addon">
                  <input type="button" id="chk_id" value="중복확인">
                  <input type="hidden" id="check" value="uncheck">
                </span>
              </div><br>
              <div class="form-group">
                <input class="form-control" placeholder="PASSWORD" id="user_pw" type="password" value=""><br>
                <input class="form-control" placeholder="PASSWORD CHECK" id="ck_user_pw" type="password" value="">
              </div>
              <button type ="submit" id="confirm" class="btn btn-primary">회원가입</button>
              <button type="button" id="cancelBtn" class="btn btn-primary" onclick="location.href='/index.php'">취소</button>
            </fieldset>
          </form>
        </div>
      </div>
    </div><!-- /.col-->
  </div><!-- /.container -->
</body>
<?php $this->load->view('script'); ?>
<script type="text/javascript">
          $('#confirm').click(function(){
              //빈칸 있는지 확인
              if($('#user_name').val() == ""){
                alert("이름을 입력해주세요.");
                $('#user_name').focus();
                return false;
              } else if($('#user_id').val() == "") {
                alert("아이디를 입력하세요.");
                $('#user_id').focus();
                return false;
              } else if($('#user_pw').val() == "") {
                alert("패스워드를 입력하세요.");
                $('#user_pw').focus();
                return false;
              }
              //패스워드 일치 확인
              if($('#user_pw').val() != $('#ck_user_pw').val()) {
                alert("비밀번호가 같지 않습니다.");
                return false;
              }
            });

          //중복확인 버튼 클릭시
          $('#chk_id').click(function(){
            $.ajax({
              url: 'new_check',
              type: 'POST',
              data: {'user_id': $('#user_id').val()},
              dataType: 'html',
              success: function(data){
                if(data) {
                  alert("사용가능한 아이디입니다.");
                  $('#chk_id').hide();
                  $('#chk_id').val('checked');
                } else {
                  alert("아이디가 중복됩니다. 다시입력해주세요.");
                  $('#chk_id').focus();
                }
                // alert(data); // 결과 텍스트를 경고창으로 보여준다.
              }
            });
          });
   </script>
</html>
