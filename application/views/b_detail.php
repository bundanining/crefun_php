<?php $this->load->view('header') ?>
<body>
  <div class="col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-md-4 col-md-offset-4">
    <div class="panel panel-default">
      <div class="panel-heading">TITLE: <?php echo $contents->title; ?></div>
      <div class="panel-body">
<<<<<<< HEAD
        <?php echo $contents->content ?>
      </div>
      <a href="/index.php/board" class="btn btn-primary">목록으로</a>
      <button id="updateBtn" class="btn btn-primary">수정하기</button>
      <button id="deleteBtn"class="btn btn-primary">삭제하기</button>
=======
        <?php echo $contents->title ?>
      </div>
      <a href="/index.php/board" class="btn btn-primary">목록으로</a>
      <a href="#" class="btn btn-primary">수정하기</a>
      <button id="deleteBtn"class="btn btn-primary">삭제하기</button>
      <input type="password" id="pw" value="">
>>>>>>> cf0af5e8a61e47e11ddebbd6218795b7fd80d9e1
    </div>
  </div>
</body>
<script type="text/javascript">
  $('#deleteBtn').click(function(){
    $.ajax({
      url: '/index.php/board/delete/<?php echo $contents->id ?>',
      type: 'POST',
      data: {'pw': $('#pw').val()},
      dataType: 'html',
      success: function(data){
        if(data=="true") {
<<<<<<< HEAD
          //console.log(data);
=======
          console.log(data);
>>>>>>> cf0af5e8a61e47e11ddebbd6218795b7fd80d9e1
          alert("삭제되었습니다.");
          location.href="/index.php/board"
        } else {
          alert("본인이 작성한 글만 삭제 가능합니다.");
        }
        // alert(data); // 결과 텍스트를 경고창으로 보여준다.
      }
    });
  });
</script>
