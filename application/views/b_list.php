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
        <div class="pull-right">
            <a class="btn btn-default" data-toggle="collapse" data-target=".board-bottom-search-collapse"><i class='fa fa-search'></i></a>
        </div>
        <div class="pull-right collapse navbar-collapse board-bottom-search-collapse">
            <div class="form-group">
                <label class="sr-only">검색</label>
                <select name=select class="form-control">
                <option value='s_title'>제목</option>
                <option value='s_content'>내용</option>
                <option value='s_writer'>작성자</option>
                </select>
            </div>
            <div class="form-group">
                <label class="sr-only" for="stx">stx</label>
                <input name=stx maxlength=15 size=10 itemname="검색어" required value='<?=stripslashes($stx)?>' class="form-control">
            </div>
            <div class="form-group">
                <label class="sr-only" for="sop">sop</label>
                <select name=sop class="form-control">
                    <option value=and>and</option>
                    <option value=or>or</option>
                </select>
            </div>
            <div class="form-group">
                <button class="btn btn-primary">검색</button>
            </div>
        </div>
        <!-- <form class="navbar-search pull-left" action="/">
            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">제목<span class="caret"></span></button>
            <input type="text" class="search-query" placeholder="검색">
            <button id="searchBtn" class="btn btn-default" type="submit">검색</button>
        </form> -->
        <ul class="pagination">
          <?php echo $this->pagination->create_links(); ?>
        </ul>
      </div>
    </div>
  </div>
</body>
