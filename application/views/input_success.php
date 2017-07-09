<?php $this->load->view('header') ?>
  <body>
    <script type="text/javascript">
    if(<?php echo $flag; ?>) {
      alert("게시글이 작성되었습니다.");
    } else {
      alert("게시글 작성에 실패하였습니다.");
    }
    document.location.href="/index.php/board";
    </script>
  </body>
<?php $this->load->view('script') ?>
