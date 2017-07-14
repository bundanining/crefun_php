<?php $this->load->view('header') ?>
<body>
  <div class="col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-md-4 col-md-offset-4">
    <div class="panel panel-default">
      <div class="panel-heading" style="text-align: center;">글쓰기 페이지</div>
      <div class="panel-body">
        <form id="form" action="/index.php/board/update_post/<?php echo $id ?>" method="post" onsubmit="return check()">
          <table class="table">
            <thead>
              <tr>
                <th>제목:<input type="text" id="title" name="title" value="<?php echo $title?>" autofocus=""></th>
              </tr>
            </thead>
            <tbody>
                <tr>
                  <td>
					<textarea rows="10" cols="20" id="content" name="content" style="width:200px; height:auto; display:none;"></textarea>
				  </td>
                </tr>
            </tbody>
          </table>
        </div>
        <div class="panel panel-footer">
          <div class="input-group">
            <button type ="submit" id="confirm" class="btn btn-primary">수정</button>
            <button type ="button" id="cancelBtn" class="btn btn-primary" onclick="location.href='/index.php/board'">취소</button>
          </div><br>
        </div>
      </form>
    </div>
  </div>
</body>
<script type="text/javascript">
$(function(){
    //전역변수선언
    var editor_object = [];
    nhn.husky.EZCreator.createInIFrame({
        oAppRef: editor_object,
        elPlaceHolder: "content",
        sSkinURI: "/smartediter/SmartEditor2Skin.html",
        htParams : {
            // 툴바 사용 여부 (true:사용/ false:사용하지 않음)
            bUseToolbar : true,            
            // 입력창 크기 조절바 사용 여부 (true:사용/ false:사용하지 않음)
            bUseVerticalResizer : true,    
            // 모드 탭(Editor | HTML | TEXT) 사용 여부 (true:사용/ false:사용하지 않음)
            bUseModeChanger : true,
        }
	});
	var sHTML = "<?php echo $content ?>";
	editor_object.getById["content"].exec("PASTE_HTML", [sHTML]);
	$('#confirm').click(function(){
       //id가 smarteditor인 textarea에 에디터에서 대입
       editor_object.getById["content"].exec("UPDATE_CONTENTS_FIELD", []);
         
       // 이부분에 에디터 validation 검증

       //폼 submit
       $("#form").submit();
    });
});
function pasteHTML() {
	
}
</script>
