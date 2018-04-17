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
      <br>
      <br>
      <br><br>

      <?php
      	mysql_connect("localhost","root","");
      	mysql_select_db("webquiz");
        mysql_set_charset("utf8");

      	$strSQL = "UPDATE resume SET password = '".trim($_POST['txtpassword'])."'
      	,firstname = '".trim($_POST['txtfirstname'])."',lastname = '".trim($_POST['txtlastname'])."'

         WHERE member_id = '".$_SESSION["member_id"]."' ";
      	$objQuery = mysql_query($strSQL);



      	if($_SESSION["level"] == "ADMIN")
      	{
					$alert = "บันทึกข้อมูลเรียบร้อยแล้ว!";
			    echo "<script language=\"JavaScript\">";
			    echo "alert('$alert');";
			    echo "</script>";
      	}
      	else
      	{
      		header("location:index.php");
      	}

      	mysql_close();
      ?>





<br>
<br>
<br>
  </body>
<?php include "footer.php"; ?>
</html>
