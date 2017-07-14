<?php $this->load->view('header') ?>
<body>
  <div class="col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-md-4 col-md-offset-4">
    <div class="panel panel-default">
      <div class="panel-heading" style="text-align: center;">글쓰기 페이지</div>
      <div class="panel-body">
        <form id="form" action="insert" method="post" onsubmit="return check()" enctype="multipart/form-data">
          <table class="table">
            <thead>
              <tr>
                <th>제목:<input type="text" id="title" name="title" value="" autofocus=""></th>
              </tr>
            </thead>
            <tbody>
                <tr>
                  <td>
				    <textarea rows="10" cols="30" id="content" name="content" style="width:650px; height:350px; "></textarea>
                  </td>
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
/*
$(document).read(function(){
  $('#form').submit(function(e){
    e.preventDefault();

    var form=$('form')[0];
    var formData = new FormData(form);
    var upfiles_cnt = $("input:file",this)[0].files.length;

    $(this).ajaxSubmit({
      dataType: 'json',
      beforeSend: function() {
        status.fadeOut();
        bar.width('0%');
        percent.html('0%');
      },
      uploadProgress: function(event,position,total,percentComplete){
        var pVel = percentComplete + '%';
        bar.width(pVel);
        percent.html(pVel);
      },
      complete: function(data){
        status.html(data.responseJSON.count+'파일이 업로드되었습니다.').fadeIn();
      },
      resetForm: true
    });
    return false;
  });
});*/


var oEditors = [];
nhn.husky.EZCreator.createInIFrame({
    oAppRef: oEditors,
    elPlaceHolder: "content",
    sSkinURI: "/smartediter/SmartEditor2Skin.html",
    fCreator: "createSEditorInIFrame"
});
 
function _onSubmit(elClicked){
    oEditors.getById["content"].exec("UPDATE_IR_FIELD", []);
    try{
        elClicked.form.submit();
    }catch(e){}
}
</script>
