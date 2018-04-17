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
      <?php include "header.php"; ?>
      <br>
      <br>
      <br><br>

      <?php
      	mysql_connect("localhost","root","");
      	mysql_select_db("webquiz");
        mysql_set_charset("utf8");

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

         WHERE member_id = '".$_SESSION["member_id"]."' ";
      	$objQuery = mysql_query($strSQL);

				$alert = "บันทึกข้อมูลเรียบร้อยแล้ว!";
		    echo "<script language=\"JavaScript\">";
		    echo "alert('$alert');";
		    echo "</script>";

      	if($_SESSION["level"] == "ADMIN")
      	{
      		echo "<center><br> คลิกเพื่อไปที่หน้าหลัก <a href='admin_page.php'>Admin page</a>";
      	}
      	else
      	{
      		echo "<center><br> คลิกเพื่อไปที่หน้าหลัก <a href='user_page.php'>User page</a>";
      	}

      	mysql_close();
      ?>





<br>
<br>
<br>
  </body>
<?php include "footer.php"; ?>
</html>
