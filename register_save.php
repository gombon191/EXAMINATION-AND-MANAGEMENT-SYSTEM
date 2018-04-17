<?php
	mysql_connect("localhost","root","");
	mysql_select_db("webquiz");
	mysql_set_charset("utf8");

	if(trim($_POST["txtusername"]) == "")
	{
		echo "โปรดใส่ชื่อผู้ใช้";
		exit();
	}

	if(trim($_POST["txtpassword"]) == "")
	{
		echo "โปรดใส่รหัสผ่าน";
		exit();
	}

	if(trim($_POST["txtfirstname"]) == "")
	{
		echo "กรุณากรอกชื่อ";
		exit();
	}

	if(trim($_POST["txtlastname"]) == "")
	{
		echo "กรุณากรอกนามสกุล";
		exit();
	}

	$strSQL = "SELECT * FROM resume WHERE username = '".trim($_POST['txtusername'])."' ";
	$objQuery = mysql_query($strSQL);
	$objResult = mysql_fetch_array($objQuery);
	if($objResult)
	{
			echo "Username already exists!";
	}
	else
	{

			mysql_connect("localhost","root","");
			mysql_select_db("webquiz");
			mysql_set_charset("utf8");

			$strSQL = "INSERT INTO resume SET username = '".trim($_POST['txtusername'])."'
			,password = '".trim($_POST['txtpassword'])."'
			,level = '".trim($_POST['level'])."'
			,firstname = '".trim($_POST['txtfirstname'])."'
			,lastname = '".trim($_POST['txtlastname'])."'
			,expect_jobs = '".trim($_POST['txtexpect_jobs'])."'
			,salary = '".trim($_POST['txtsalary'])."'
			,age = '".trim($_POST['txtage'])."'
			,adr = '".trim($_POST['txtadr'])."'
			,tamboon = '".trim($_POST['txttamboon'])."'
			,amphur = '".trim($_POST['txtamphur'])."'
			,prov = '".trim($_POST['txtprov'])."'
			,post_id = '".trim($_POST['txtpost_id'])."'
			,phone = '".trim($_POST['txtphone'])."'
			,email = '".trim($_POST['txtemail'])."'
			,lang = '".trim($_POST['txtlang'])."'
			,computing = '".trim($_POST['txtcomputing'])."'
			,other_skill = '".trim($_POST['txtother_skill'])."'
			,driving_license = '".trim($_POST['driving_license'])."'";
			$objQuery = mysql_query($strSQL);

			$alert = "ลงทะเบียนเรียบร้อยแล้ว!";
			echo "<script language=\"JavaScript\">";
			echo "alert('$alert');";
			echo "</script>";

		echo "<br> Go to <a href='login.php'>Login page</a>";

	}

	mysql_close();
?>
