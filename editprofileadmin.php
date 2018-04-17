<?php
	session_start();
	if($_SESSION['member_id'] == "")
	{
    $alert = "กรุณาเข้าสู่ระบบ!";
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
  <script src="ckeditor/ckeditor.js"></script>
  <script>
CKEDITOR.replace('question');
function CKupdate() {
for (instance in CKEDITOR.instances)
CKEDITOR.instances[instance].updateElement();
}
</script>
  <title>KHON KAEN BREWERY</title>
</head>
  <body>
    <?php include "headeradmin.php"; ?>
		<?php
$objConnect = mysql_connect("localhost","root","") or die("Error Connect to Database");
$objDB = mysql_select_db("webquiz");
$strSQL = "SELECT * FROM resume";
$objQuery = mysql_query($strSQL) or die ("Error Query [".$strSQL."]");
?>
    <br>
    <br>
    <br><br>

    <div class="container">
			<center>
			<h1>สำหรับแก้ไขข้อมูลผู้ดูแลระบบ</h1>
		</center>
		<br>
    <div class="table-responsive">
<form class="form" action="saveprofileadmin.php" method="post">
<table class="table">

    <tr>
      <th>รหัสผู้ใช้</th>
      <td>
        <div class="col-sm-8">
        <input name="txtmember_id" class="form-control" value="<?=$objResult["member_id"];?>" readonly/>
      </td>
      <th>สถานะ</th>
      <td>
        <div class="col-sm-8">
        <input name="txtlevel" class="form-control" value="<?=$objResult["level"];?>" readonly/>
      </td>
    </tr>

    <tr>
    <th>Username</th>
    <td>
      <div class="col-sm-8">
      <input type="text" name="txtusername" maxlength="20" class="form-control" value="<?=$objResult["username"];?>" readonly>
    </td>
    <th>Password</th>
    <td>
      <div class="col-sm-8">
      <input type="password" name="txtpassword" id="txtpassword" maxlength="20" class="form-control" value="<?=$objResult["password"];?>">
    </td>
  </tr>

    <tr>
    <th>ชื่อ</th>
    <td>
      <div class="col-sm-8">
      <input type="text" name="txtfirstname" class="form-control" value="<?=$objResult["firstname"];?>"></td>
    <th>นามสกุล</th>
    <td>
      <div class="col-sm-8">
      <input type="text" name="txtlastname" class="form-control" value="<?=$objResult["lastname"];?>"></td>
  </tr>
</table>
<center>
<input type="submit" class="btn btn-info" role"button" name="Submit" value="Save"></center>
</form>
</div>
</div>
<br>
<br>
<br>
  </body>
<?php include "footer.php"; ?>
</html>
