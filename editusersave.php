<?php
	session_start();
	if(@$_SESSION['member_id'] == "")
	{
    $alert = "กรุณาเข้าสู่ระบบ! หน้านี้สำหรับผู้ใช้ระดับ ผู้ดูแลเท่านั้น";
    echo "<script language=\"JavaScript\">";
    echo "alert('$alert');";
    echo "</script>";
		exit();
	}
	if(@$_SESSION['level'] != "ADMIN")
	{
		$alert = "หน้านี้สำหรับผู้ใช้ระดับ ผู้ดูแลเท่านั้น";
    echo "<script language=\"JavaScript\">";
    echo "alert('$alert');";
    echo "</script>";
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
<html lang="en" dir="ltr">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" type="text/css" href="css/style.css">
  <link rel="stylesheet" type="text/css" href="css/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="../js/bootstrap.min.js"></script>
  <title>KHON KAEN BREWERY</title>
</head>
  <body>
    <?php include "headeradmin.php"; ?>
		<?php
		$objConnect = mysql_connect("localhost","root","") or die("Error Connect to Database");
		$objDB = mysql_select_db("webquiz");
		$strSQL = "UPDATE resume SET password = '".trim($_POST['txtpassword'])."'
		,firstname = '".trim($_POST['txtfirstname'])."',lastname = '".trim($_POST['txtlastname'])."'
		,expect_jobs = '".trim($_POST['txtexpect_jobs'])."',salary = '".trim($_POST['txtsalary'])."'
		,age = '".trim($_POST['txtage'])."',adr = '".trim($_POST['txtadr'])."'
		,tamboon = '".trim($_POST['txttamboon'])."',amphur = '".trim($_POST['txtamphur'])."'
		,prov = '".trim($_POST['txtprov'])."'
		,post_id = '".trim($_POST['txtpost_id'])."'
		,phone = '".trim($_POST['txtphone'])."',email = '".trim($_POST['txtemail'])."'
		,lang = '".trim($_POST['txtlang'])."',computing = '".trim($_POST['txtcomputing'])."'
		,other_skill = '".trim($_POST['txtother_skill'])."'
		,driving_license = '".trim($_POST['driving_license'])."'
		 WHERE member_id = '".$_GET["member_id"]."' ";
$objQuery = mysql_query($strSQL);
if($objQuery)
{
	$alert = "บันทึกข้อมูลเรียบร้อยแล้ว!";
	echo "<script language=\"JavaScript\">";
	echo "alert('$alert');";
	echo "</script>";
}
else
{
	$alert = "บันทึกข้อมูลล้มเหลว!";
	echo "<script language=\"JavaScript\">";
	echo "alert('$alert');";
	echo "</script>";
}
mysql_close($objConnect);
?>
<br>
<br>
<br>
<center><br> คลิกเพื่อไปที่หน้าหลัก <a href='admin_page.php'>Admin page</a>
<br>
<br>
<br>
  </body>
<?php include "footer.php"; ?>
</html>
