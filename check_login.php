<?php
	session_start();
	mysql_connect("localhost","root","");
	mysql_select_db("webquiz");
	$strSQL = "SELECT * FROM resume WHERE username = '".mysql_real_escape_string($_POST['txtusername'])."'
	and Password = '".mysql_real_escape_string($_POST['txtpassword'])."'";
	$objQuery = mysql_query($strSQL) or die(mysql_error());
	$objResult = mysql_fetch_array($objQuery) or die(mysql_error());
	if(!$objResult)
	{
		$alert = "กรุณาเข้าสู่ระบบ!";
		echo "<script language=\"JavaScript\">";
		echo "alert('$alert');";
		echo "</script>";
	}
	else
	{
			$_SESSION["member_id"] = $objResult["member_id"];
			$_SESSION["level"] = $objResult["level"];

			session_write_close();

			if($objResult["level"] == "ADMIN")
			{
				header("location:admin_page.php");
			}
			else
			{
				header("location:user_page.php");
			}
	}
	mysql_close();
?>
