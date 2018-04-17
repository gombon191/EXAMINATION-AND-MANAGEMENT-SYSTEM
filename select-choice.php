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


include "connectdb.php";

$testee_id = $_SESSION['member_id'];
$subject_id = $_POST['subject_id'];

//ป้องกันการทำแบบทดสอบหัวเดิมซ้ำ(อาจเกิดกรณีผู้ใช้เปิดหลายเบราเซอร์พร้อมกัน)
$sql = "SELECT COUNT(*) FROM score
 			WHERE subject_id = $subject_id AND member_id = $member_id";

$result = mysqli_query($link, $sql);
$row = mysqli_fetch_array($result);

if($row[0] !=0) {
	mysqli_close($link);
	exit("alert('ท่านได้ทำแบบสอบทดสอบนี้ไปแล้ว ไม่สามารถทำซ้ำได้อีก');
			 window.location = 'index.php';");
}

//ตรวจสอบว่าอยู่ในช่วงวันเวลาที่กำหนดในการทำแบบทดสอบหรือไม่
$sql = "SELECT date_test, date_start, date_end
 			FROM subject WHERE subject_id = $subject_id";

$result = mysqli_query($link, $sql);
$row = mysqli_fetch_array($result);

$now = strtotime("now");
$start = $row[0] . " " . $row[1];
$end = $row[0] . " " . $row[2];
$start = strtotime($start);
$end = strtotime($end);
//ถ้ากำหนดวันเวลาในการทำแบบทดสอบ และไม่อยู่ในช่วงเวลานั้น
//ให้โหลดเพจ testing.phpใหม่ ซึ่งจะไปบรรจบกับการตรวจสอบภายในเพจนี้พอดี
if(($row[0] != "0000-00-00") && (($now < $start) || ($now > $end))) {
	mysqli_close($link);
	exit("window.location = 'testing.php?subject_id=$subject_id';");
}

$tid = $_SESSION['member_id'];
$sid = $_POST['subject_id'];
$qid = $_POST['question_id'];
$cid = $_POST['choice_id'];
//ถ้าไม่มีอะไรผิดพลาด ก็ให้บันทึกข้อมูลลงในตาราง testing
$sql = "REPLACE INTO testing VALUES('$tid', '$sid', '$qid', '$cid')";
mysqli_query($link, $sql);
mysqli_close($link);
?>
