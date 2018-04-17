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
		<?php
		$objConnect = mysql_connect("localhost","root","") or die("Error Connect to Database");
		$objDB = mysql_select_db("webquiz");
		$strSQL = "DELETE FROM resume WHERE member_id = '".$_GET["member_id"]."' ";
$objQuery = mysql_query($strSQL);
if($objQuery)
{
	$alert = "ลบข้อมูลเรียบร้อยแล้ว!";
	echo "<script language=\"JavaScript\">";
	echo "alert('$alert');";
	echo "</script>";
}
else
{
	$alert = "ลบข้อมูลล้มเหลว!";
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
