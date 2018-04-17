<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="css/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/login.css">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="https://use.typekit.net/ayg4pcz.js"></script>
  <script>try{Typekit.load({ async: true });}catch(e){}</script>
    <title>KHON KAEN BREWERY</title>
  </head>
  <header>
  <nav class="navbar navbar-fixed-top navbar-expand-lg" id="Nav">
<div class="container">
    <a class="navbar-brand" href="../index.php"><b>KHONKAENBREWERY</b></a>
            <ul class="nav navbar-nav navbar-right">
              <li>
                <a href="register.php">
                <span class="glyphicon glyphicon-user">
                </span> สมัครสมาชิก</a>
              </li>
                  <li><a <a href="login.php">
                      <span class="glyphicon glyphicon-log-in">
                      </span> ลงชื่อเข้าใช้</a>
                  </li>
            </ul>
      </div>
</nav>
  </header>
  <body>
    <br>
    <br>


<div class="container">
    <h1 class="welcome text-center">ยินดีต้อนรับสู่ <br> การสอบคัดเลือกบุคลากรเข้าทำงาน</h1>
        <div class="card card-container">
        <h2 class='login_title text-center'>กรุณาเข้าสู่ระบบ</h2>
        <hr>

            <form class="form-signin" name="form1" method="post" action="check_login.php">
                <span id="reauth-email" class="reauth-email"></span>
                <p class="input_title">Email</p>
                <input type="text" id="txtusername" name="txtusername" class="login_box" placeholder="user01@IceCode.com" required autofocus>
                <p class="input_title">Password</p>
                <input type="password" id="txtpassword" name="txtpassword" class="login_box" placeholder="******" required>
                <div id="remember" class="checkbox">
                    <label>

                    </label>
                </div>
                <button class="btn btn-lg btn-primary" type="submit" name="Submit" value="Login">Login</button>
            </form><!-- /form -->
        </div><!-- /card-container -->
    </div><!-- /container -->
  </body>
<div class="footer navbar-fixed-bottom">
  <footer>
        <p class="text-center">เยี่ยมชมเว็บไซต์ บริษัท ขอนแก่น บริวเวอรี่ จำกัด <a href="http://kkb.boonrawd.co.th/th/index">คลิก</a> <br> © 2016 singha corporation co., ltd. all rights reserved.</p>
      </footer>
</div>
</html>
