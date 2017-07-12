<?php $this->load->view('header') ?>
<body>
  <div class="col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-md-4 col-md-offset-4">
    <div class="panel panel-default">
      <div class="panel-heading">TITLE: <?php echo $contents->title; ?> </div>
      <div class="panel-body">
        <?php echo $contents->content; ?><br>
        <img src="<?php echo $contents->path; ?>" alt="">
      </div>
      <a href="/index.php/board" class="btn btn-primary">목록으로</a>
      <button id="updateBtn" class="btn btn-primary">수정하기</button>
      <button id="deleteBtn"class="btn btn-primary">삭제하기</button>
    </div>
  </div>
</body>
<script type="text/javascript">
  $('#deleteBtn').click(function(){
    $.ajax({
      url: '/index.php/board/delete/<?php echo $contents->id; ?>',
      type: 'POST',
      data: {'pw': $('#pw').val()},
      dataType: 'html',
      success: function(data){
        if(data=="true") {
          //console.log(data);
          alert("삭제되었습니다.");
          location.href="/index.php/board";
        } else {
          alert("본인이 작성한 글만 삭제 가능합니다.");
        }
        // alert(data); // 결과 텍스트를 경고창으로 보여준다.
      }
    });
  });
  $('#updateBtn').click(function(){
    $.ajax({
      url: '/index.php/board/update/<?php echo $contents->id; ?>',
      type: 'POST',
      data: {
        'title': $('#title').val(),
        'content': $('#content').val()
      },
      dataType: 'html',
      success: function(data){
        if(data) {
          location.href="/index.php/board/update/<?php echo $contents->id; ?>";
        } else {
          alert("본인이 작성한 글만 수정 가능합니다.");
        }
        // alert(data); // 결과 텍스트를 경고창으로 보여준다.
      }
    });
  });
</script>
