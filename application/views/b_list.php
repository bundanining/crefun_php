<?php $this->load->view('header') ?>
<body>
  <div class="col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-md-4 col-md-offset-4">
    <div class="panel panel-default">
      <div class="panel-heading" style="text-align: center;"><p>글 목록 페이지</p>
        <?php
            if (@$this -> session -> userdata('logged_in') == TRUE) {
        ?>
        <?php echo $this -> session -> userdata('user_name');?> 님 환영합니다.
        <a id="logoutBtn" href="/index.php/user/logout" class="btn btn-primary">로그아웃</a>
        <?php
            } else {
        ?>
        <a href="/index.php" class="btn btn-primary"> 로그인 </a>
        <?php
            }
        ?>
      </div>
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
                <th><a href="/index.php/board/list/<?php echo $row->id;?>"><?php echo $row->title; ?></a></th>
                <th><?php echo $row->user_name; ?></th>
                <th><?php echo $row->hit; ?></th>
                <th><?php echo $row->date; ?></th>
              </tr>
            <?php
            } ?>
          </tbody>
          <tfoot>
            <tr>
              <th>
                <div class="input-group">
                  <div class="input-group-btn">
                    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">글 제목<span class="caret"></span></button>
                    <ul class="dropdown-menu" role="menu">
                      <li><a href="#">글제목</a></li>
                      <li><a href="#">글내용</a></li>
                      <li><a href="#">작성자</a></li>
                    </ul>
                  </div><!-- /btn-group -->
                  <input type="text" class="form-control" aria-label="...">
                  <span class="input-group-btn">
                    <button class="btn btn-default" type="button">Search</button>
                  </span>
                </div><!-- /input-group -->
              </th>
              <th colspan="5">
                  <a href="/index.php/board">
                    <span id="list" class="glyphicon glyphicon-menu-hamburger"></span>
                  </a>
                  <a href="/index.php/board/write">
                    <span id="write" class="glyphicon glyphicon-pencil"></span>
                  </a>
                  <a href="/index.php">
                    <span id="main" class="glyphicon glyphicon-home"></span>
                  </a>
              </th>
            </tr>
            <tr>
              <th align= "center" colspan="5">
                <ul class="pagination">
                  <?php echo $this->pagination->create_links(); ?>
                </ul>
            </th>
            </tr>
          </tfoot>
        </table>
      </div>
    </div>
  </div>
</body>
