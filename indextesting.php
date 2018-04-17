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
    <title>KHON KAEN BREWERY</title>
  </head>


<script src="js/jquery-2.1.1.min.js"></script>
<script>
$(function() {

});
</script>
</head>

<body>
	<br><br><br><br>
	<div class="container">
  <?php
include "headermanageexam.php";
   ?>
	 <article>

 <section id="top">
 <?php
 $bg_img = "";
 if($_SESSION['level']  == "USER") {  //ถ้าเป็นผู้เข้าทำแบบทดสอบ
 	echo '<a href="score.php">ดูผลคะแนนทั้งหมด</a>';
 	$bg_img = "ok.png";
 }
 else if($_SESSION['level'] == "ADMIN") {  //ถ้าเป็นผู้ทดสอบ
 	echo '<a href="new_event.php" class="btn btn-info">เพิ่มหัวข้อการทดสอบ</a><br><br>';
 	$bg_img = "plus.png";
 }
 echo "<script> $('section#top a').css('background-image', 'url(images/$bg_img)'); </script>";
 ?>


 <div class="well">
     <h3>หัวข้อการทดสอบ</h3>
    <span>ลำดับที่ ? - ? จากทั้งหมด ?</span> <!-- จะนำข้อมูลมาเติมทีหลังด้วย jQuery -->
 </section>

 <section>
	 <div class="well">
 <?php
 include "connectdb.php";
 include "lib/pagination.php";
 //อ่านหัวข้อแบบทดสอบจากตาราง subject
 //ให้รูปแบบวันเดือนปีให้เป็น date-month-year และเวลาเป็น hour:minute
 $sql = "SELECT *,
  				DATE_FORMAT(date_test, '%d-%m-%Y') AS date_test,
 				TIME_FORMAT(date_start, '%H:%i') AS date_start,
 				TIME_FORMAT(date_end, '%H:%i') AS date_end
 			FROM subject ORDER BY subject_id DESC";

 $result = page_query($link, $sql, 10);    //ใช้ฟังก์ชั่นนี้เพราะต้องการแบ่งเพจ(รายละเอียดในบทที่ 12)

 while($data = mysqli_fetch_array($result)) {
 	$subject_id = $data['subject_id'];
 	$dt = "วันที่ " . $data['date_test'] . " เวลา " . $data['date_start'] . " - " . $data['date_end'];
 	if($data['date_test'] == "00-00-0000") {   //กรณีที่ไม่กำหนดวันเวลาทำแบบทดสอบเอาไว้
 		$dt = "ไม่ระบุ";
 	}
 	$sql = "SELECT COUNT(*) FROM question WHERE subject_id = $subject_id";  //นับจำนวนคำถามของหัวข้อนี้
 	$r = mysqli_query($link, $sql);
 	$num_q = 0;
 	if($r) {
 		$row = mysqli_fetch_array($r);
 		$num_q = $row[0];
 	}
 	//สร้างปุ่มให้สอดคล้องกับชนิดผู้ใช้ระหว่าง tester และ testee
 	$bt = "";
 	$q = "subject_id=$subject_id";
 	if($_SESSION['level']  == "USER") {
 		$bt = '<a href="testing.php?'.$q.'">ทำแบบทดสอบ</a>';
 	}
 	else if($_SESSION['level'] == "ADMIN") {
 		$bt = '<a href="add_exam.php?'.$q.'" class="btn btn-info"><span class="glyphicon glyphicon-plus"></span> เพิ่มแบบทดสอบ</a>  '.
 				'<a href="listexam.php?'.$q.'" class="btn btn-success"><span class="glyphicon glyphicon-file"></span> ดูแบบทดสอบ</a>  '.
 				'<a href="editexam.php"class="btn btn-warning"><span class="glyphicon glyphicon-edit"></span> ลบ/แก้ไข</a>  ';
 	}
 	echo '<div class="subject">'.$data['subject_name'].'</div>
 			<div class="question">'.$num_q.' คำถาม</div><br>
 			<div class="datetime">กำหนดทำแบบทดสอบ: '.$dt.'</div>
 			<div class="button">'.$bt.'<a href="score.php?'.$q.'" class="btn btn-danger"><span class="glyphicon glyphicon-search"></span> ผลคะแนน</a></div><hr>';
 }
 $start = page_start_row();
 $stop = page_stop_row();
 $total = page_total_rows();

 //ย้อนกลับไปอัปเดตการแสดงช่วงหัวข้อที่ section#top ด้วยคำสั่ง jQuery
 $msg = "ลำดับที่ $start - $stop จากทั้งหมด $total";
 echo "<script> $('section#top h3+span').html('$msg'); </script>"; //span ถัดจาก h3 ที่อยู่ใน section#top

 mysqli_close($link);
 ?>
</div>
 <div class="well">
 <?php
 if(page_total() > 1) {		//ถ้ามีจำนวนหน้ามากกว่า 1 ให้แสดงหมายเลขหน้า
 	page_link_color("blue", "red");
 	echo page_echo_pagenums();
 }
 ?>
 </div>
 </section>

 </article>


  </div>
	<br><br><br>
</body>
<?php include "footer.php"; ?>
</html>
