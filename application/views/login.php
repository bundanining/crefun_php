<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Login</title>

<!-- 합쳐지고 최소화된 최신 CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">

<!-- 부가적인 테마 -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap-theme.min.css">

<!-- 합쳐지고 최소화된 최신 자바스크립트 -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
<!-- <link href="css/styles.css" rel="stylesheet"> -->

</head>

<body>
  <div class="container">
    <div class="col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-md-4 col-md-offset-4">
      <div class="login-panel panel panel-default">
        <div class="panel-heading">LOGIN</div>
        <div class="panel-body">
          <form role="form" action="index.php/user/user_check" method="post">
            <fieldset>
              <div class="form-group">
                <input class="form-control" placeholder="USER ID" name="user_id" type="text" autofocus="" value="">
              </div>
              <div class="form-group">
                <input class="form-control" placeholder="PASSWORD" name="user_pw" type="password" value="">
              </div>
              <button type="submit" class="btn btn-primary">Login</button>
            </fieldset>
          </form>
          <a href="index.php/user/join">회원가입</a>
        </div>
      </div>
    </div><!-- /.col-->
  </div><!-- /.row -->

  <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
  <script>
    !function ($) {
      $(document).on("click","ul.nav li.parent > a > span.icon", function(){
        $(this).find('em:first').toggleClass("glyphicon-minus");
      });
      $(".sidebar span.icon").find('em:first').addClass("glyphicon-plus");
    }(window.jQuery);
    $(window).on('resize', function () {
      if ($(window).width() > 768) $('#sidebar-collapse').collapse('show')
    })
    $(window).on('resize', function () {
      if ($(window).width() <= 767) $('#sidebar-collapse').collapse('hide')
    })
  </script>
</body>

</html>
