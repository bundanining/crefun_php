<?php $this->load->view('header') ?>
<body>
  <div class="col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-md-4 col-md-offset-4">
    <div class="panel panel-default">
      <div class="panel-heading" style="text-align: center;">글 목록 페이지</div>
      <div class="panel-body">
        <table class="table">
          <thead>
            <tr>
              <th>번호</th>
              <th>제목</th>
              <th>글쓴이</th>
              <th>조회수</th>
              <th>날짜</th>
            </tr>
          </thead>
          <tbody>
            <?php
            foreach ($list as $row)
            {
            ?>
              <tr>
                <th><?php echo $row->id; ?></th>
                <th><a href="board/list/<?php echo $row->id;?>"><?php echo $row->title; ?></a></th>
                <th><?php echo $row->writer; ?></th>
                <th><?php echo $row->hit; ?></th>
                <th><?php echo $row->date; ?></th>
              </tr>
            <?php
            } ?>
          </tbody>
          <tfoot>
            <tr>
              <th colspan="5">
                  <a href="board" class="btn btn-primary">목록 </a>
                  <a href="board/write" class="btn btn-primary">글쓰기 </a>
                  <a href="logout" class="btn btn-primary">로그아웃 </a>
                  <a href="board" class="btn btn-primary">메인으로 </a>
              </th>
          </tr>
          </tfoot>
        </table>
      </div>
    </div>
  </div>
</body>
