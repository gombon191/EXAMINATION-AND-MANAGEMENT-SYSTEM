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

	if($_SESSION['level'] != "ADMIN")
	{
		echo "หน้านี้สำหรับผู้ใช้ระดับ ผู้ดูแลเท่านั้น กรุณาเข้าสู่ระบบ";
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
		<script src=".js/jquery-2.1.1.min.js"></script>
		<script>
$(function() {
	$('#ok').click(function(event) {
		if($(':text').val().length == 0) {
			alert('ท่านยังไม่ได้กำหนดหัวข้อการทดสอบ');
			return;
		}

		if($(':radio:checked').length == 0) {
			alert('ท่านยังไม่ได้กำหนดวันเวลาที่จะทดสอบ');
			return;
        }
		$('form').submit();
	});

	$('#cancel').click(function() {
		window.location = 'index.php';
	});
});
</script>
    <title>KHON KAEN BREWERY</title>
  </head>

<body>

	<?php
$msg = "";

if($_POST) {
	include "connectdb.php";

	$event = $_POST['event'];
	$date_test = $_POST['date'];
	$time_start = "";
	$time_end = "";
	if($_POST['datetime']=="yes") {
		$time_start = $_POST['time_start'];
		$time_end = $_POST['time_end'];
	}

	$sql = "REPLACE INTO event_test VALUES(
				'', '$event', '$date_test', '$time_start', '$time_end')";

	if(@mysqli_query($link, $sql)) {
		$alert = "จัดเก็บข้อมูลแล้ว...เพิ่มหัวข้อถัดไปหรือกลับ ";
    echo "<script language=\"JavaScript\">";
    echo "alert('$alert');";
    echo "</script>";
		$msg = '<h4><a href="admin_page.php">กลับหน้าหลัก</a></h4>';
	}
	else {
		$alert = "เกิดข้อผิดพลาดในการบันทึกข้อมูล กรุณาลองใหม!";
    echo "<script language=\"JavaScript\">";
    echo "alert('$alert');";
    echo "</script>";
	}

	mysqli_close($link);
}
?>
  <?php
include "headermanageexam.php";
   ?>

    <br>
    <br>
    <br>
    <br>
		<div class="container">
			<div class="jumbotron">
		<article>
<section id="top">
<center>	<h3>เพิ่มหัวข้อการทดสอบ</h3></center>
    <span>หากกำหนดวันเวลา จะทำให้ผู้เข้าทดสอบสามารถทำแบบทดสอบได้เฉพาะในวันและช่วงเวลาที่กำหนดเท่านั้น</span>
</section>

<section id="content">
<?php echo $msg;  ?>
<form method="post">
	<label>หัวข้อการทดสอบ:</label><input type="text" name="event"><br>
    <label>วันเวลาที่จะทดสอบ:</label><input type="radio" name="datetime" value="no">ไม่กำหนด (ทดสอบเมื่อไหร่ก็ได้)<br>
    <label></label><input type="radio" name="datetime" value="yes">กำหนดวันเวลา
     	<input type="date" name="date"> <input type="time" name="time_start"> - <input type="time" name="time_end">

    <br><br>
		<center>
		<input type="submit" class="btn btn-info" role"button" name="Submit" value="Save" id="ok">
		<a href="admin_page.php" class="btn btn-info" role"button">ยกเลิก</a></center>
	</div>
	</div>
</form>
</section>

</article>


  </div>
</body>
<?php include "footer.php"; ?>
</html>
