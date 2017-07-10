<?php $this->load->view('header') ?>
<body>
  <div class="col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-md-4 col-md-offset-4">
    <div class="panel panel-default">
      <div class="panel-heading" style="text-align: center;">글쓰기 페이지</div>
      <div class="panel-body">
        <form action="insert" method="post" onsubmit="return check()" enctype="multipart/form-data">
          <table class="table">
            <thead>
              <tr>
                <th>제목:<input type="text" id="title" name="title" value="" autofocus=""></th>
              </tr>
            </thead>
            <tbody>
                <tr>
                  <th>
                    <input type="text" id="content" name="content" value="" style="width:400px; height:450px;">
                  </th>
                </tr>
            </tbody>
          </table>
        </div>
        <div class="panel panel-footer">
          <div class="input-group">
            <input id="userfile" type="file" name="userfile" size="20" />
            <button type ="submit" id="confirm" class="btn btn-primary">글작성</button>
            <button type ="button" id="cancelBtn" class="btn btn-primary" onclick="location.href='/index.php/board'">취소</button>
          </div><br>
        </div>
      </form>
    </div>
  </div>
</body>
<script type="text/javascript">
function check() {
    if($('#title').val() == "" || $('#content').val()== ""){
      alert('모든 내용을 채워주세요!!');
      return false;
    }else {
      return true;
    }
}
</script>
