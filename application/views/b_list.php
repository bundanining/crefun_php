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
          </tfoot>
        </table>
        <form class="form-group form-inline" method="get" action="/index.php/board/search">
            <select class="form-control" name="searchItem" id="searchItem">
              <option value="b_title">제목</option>
              <option value="b_content">내용</option>
              <option value="b_writer">작성자</option>
            </select>
            <input name="searchBox" id="searchBox" type="text" class="form-control" placeholder="검색">
            <button class="btn btn-default" type="submit">검색</button>
        </form>
        <ul class="pagination">
          <?php echo $this->pagination->create_links(); ?>
        </ul>
      </div>
    </div>
  </div>
</body>
