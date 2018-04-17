<?php
mysql_connect("localhost","root","");
mysql_select_db("webquiz");
mysql_set_charset("utf8");
$strSQL = "SELECT * FROM resume WHERE member_id = '".$_SESSION['member_id']."' ";
$objQuery = mysql_query($strSQL);
$objResult = mysql_fetch_array($objQuery);
 ?>
<header>
<nav class="navbar navbar-fixed-top navbar-expand-lg" id="Nav">
  <div class="container">
  <ul class="nav navbar-nav navbar-left">
    <li>
      <a <a href="editprofileuser.php">
        <span class="glyphicon glyphicon-user"></span>&nbsp; <font color="black">ยินดีต้อนรับคุณ "<?=@$objResult["firstname"];?>"</font></a>
    </li>
  </ul>
  <ul class="nav navbar-nav navbar-right">
    <li><a <a href="user_page.php">
        <span class="glyphicon glyphicon-list"></span> หน้าแรก</a>
    </li>
          <li><a <a href="score.php">
              <span class="glyphicon glyphicon-list"></span> ผลการสอบ</a>
          </li>
          <li>
          <a href="logout.php"><span class="glyphicon glyphicon-off"></span> &nbsp;Logout</a>
          </li>
          </ul>
  </div>
        </nav>
</header>
