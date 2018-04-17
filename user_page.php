<?php
	session_start();
	if(@$_SESSION['member_id'] == "")
	{
    $alert = "กรุณาเข้าสู่ระบบ!";
    echo "<script language=\"JavaScript\">";
    echo "alert('$alert');";
    echo "</script>";
		exit();
	}

	if($_SESSION['level'] != "USER")
	{
		echo "หน้านี้สำหรับสมาชิกเท่านั้น กรุณาเข้าสู่ระบบ";
		exit();
	}
  mysql_connect("localhost","root","");
	mysql_select_db("webquiz");
	mysql_set_charset("utf8");
	$strSQL = "SELECT * FROM resume WHERE member_id = '".$_SESSION['member_id']."' ";
	$objQuery = mysql_query($strSQL);
	$objResult = mysql_fetch_array($objQuery);
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="css/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="./js/bootstrap.min.js"></script>
    <title>KHON KAEN BREWERY</title>
  </head>
<body>
  <?php
  include "headeruser.php";
  ?>

  <div class="container-fulid text-center hero-section mb-0">

            <img src="img/logosing.png" width="300px" alt="logosing"><br>
            <a href="indextestinguser.php" class="btn btn-warning" role"button">เริ่มทำข้อสอบ</a>

  </div>
</body>

<?php
include "footer.php";
 ?>
</html>
