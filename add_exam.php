<?php
include "check_user.php";
//ต้องเป็นผู้ทดสอบเท่านั้นที่จะเปิดเพจนี้ได้(ป้องกันการเปิดเพจนี้โดยตรงของผู้เข้าทดสอบ)
if($_SESSION['level'] != "ADMIN") {
	die("<h2>For Tester Only</h2>");
}
else if(!$_GET['subject_id']) {
	die("<h2>Require Subject ID</h2>");
}
$strSQL = "SELECT * FROM resume WHERE member_id = '".$_SESSION['member_id']."' ";
$objQuery = mysql_query($strSQL);
$objResult = mysql_fetch_array($objQuery);
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="css/style.css">
<link rel="stylesheet" type="text/css" href="css/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="../js/bootstrap.min.js"></script>
<title>Web Testing</title>
<style>
	@import "global.css";
	form {
		width: 700px;
		border: solid 0px green;
		border-radius: 8px;
 		margin: 10px auto 15px;
		padding: 10px 0px;
		background: #cee;
	}
	form input:not([type=radio]) {
		background: #ffd;
		border: solid 1px gray;
		padding: 2px;
		color: blue;
	}
	form [type=file] {
		background: inherit !important;
		border:none !important;
	}
	form label {
		display: inline-block;
		width: 180px;
		text-align: right;
		padding: 5px;
	}
	form div {
		text-align: center;
		margin-top: 10px;
	}
	form button {
		background: steelblue;
		color: white;
		border: solid 1px orange;
		padding: 3px;
		width: 80px;
		margin-right: 50px;
	}
	form button:hover {
		color: aqua;
		cursor: pointer;
	}
	form input[name=question] {
		width: 450px;
	}
	form input[type=file] {
		width: 300px;
	}
	form input[name^=choice] {
		width: 300px;
		margin: 2px 0px;
	}
	section#content h4 {
		text-align: center;
		color: green;
	}
	section#content h4.err {
		color: red;
	}
	section#content h4 img {
		margin-right: 3px;
		vertical-align: middle;
	}
</style>
<script src="js/jquery-2.1.1.min.js"></script>
<script>



$(function() {
	$('#ok').click(function(event) {
		var error = false;
		$(':text').each(function() {
			if($(this).val().length == 0) {
				alert('ท่านใส่ข้อมูลยังไม่ครบ');
				error  = true;
				return false;
			}
        });

		if(error) {
			return;
		}

		if($(':radio:checked').length == 0) {
			alert('ท่านยังไม่ได้กำหนดตัวเลือกที่เป็นคำตอบ');
			return;
        }

		$('form').submit();
	});

	$('#cancel').click(function() {
		window.location = 'index.php';
	});
});
</script>
</head>




<body>
	<br><br><br><br>
<?php
include "connectdb.php";
$subject_id = $_GET['subject_id'];

$msg = "";
$img = "no.png";
if($_POST) {
	$subject_id = $_POST['subject_id'];
	$q = $_POST['question'];
	$f = "";
	$t = "";
	$msg = "";
	//ถ้ามีการอัปโหลดไฟล์รูปภาพขึ้นมา จะใช้ไลบรารี Imager มาปรับขนาด
	//เพื่อป้องกันการใช้รูปภาพที่มีขนาดใหญ่เกินไป (รายละเอียดอยู่ในบทที่ 14)
	if(is_uploaded_file($_FILES['file']['tmp_name']))  {
		$error =  $_FILES['file']['error'];
		if($error == 0) {
			include "lib/IMager/imager.php";
			$img = image_upload('file');
			$img = image_to_jpg($img);
			$img = image_resize_max($img, 500, 200); //ให้ภาพกว้างไม่เกิน 200px สูงไม่เกิน 200px
			$f = image_store_db($img, "image/jpeg");
		}
		else if($error == 1 || $error == 2 ) {
			$msg = "ไฟล์ที่อัปโหลดมีขนาดใหญ่เกินกำหนด";
		}
		else if($error == 4) {
			$msg = "เกิดข้อผิดพลาดในระหว่างอัปโหลดไฟล์";
		}
	}

	if($msg=="") {
		//เพิ่มคำถามลงในตาราง question ก่อน
		$sql = "REPLACE INTO question VALUES('', '$subject_id', '$q', '$f')";
		if(@mysqli_query($link, $sql)) {
			//อ่านค่า id ของคำถามที่เพิ่มใหม่ เพื่อนำไปเชื่อมโยงกับตัวเลือกในตาราง choice
			$question_id = mysqli_insert_id($link);

			//ตัวเลือกถูกส่งขึ้นมาในรูปแบบอาร์เรย์ เราจะใส่ลงในตาราง choice ทีละตัวเลือก
			for($i = 1; $i <= count($_POST['choice']); $i++) {
				$choice_text = $_POST['choice'][$i];
				$answer = "no";
				if($_POST['answer'] == $i) {	//ถ้าตัวเลือกนั้นถูกกำหนดให้เป็นคำตอบ(ดูเลขลำดับอาร์เรย์ในฟอร์มประกอบ)
					$answer =  "yes";
				}
				$sql = "REPLACE INTO choice VALUES('', '$question_id', '$choice_text', '$answer' ,'')";
				mysqli_query($link, $sql);
			}
			$msg = 'บันทึกข้อมูลเรียบร้อยแล้ว<br>กรุณาใส่ข้อมูลคำถามถัดไป หรือกลับไปยัง <a href="index.php">หน้าหลัก</a>';
			$img = "ok.png";
		}
		else {
			$msg = "เกิดข้อผิดพลาดในการบันทึกข้อมูล กรุณาลองใหม่";
		}
	}

	$msg = "<h4><img src=\"images/$img\">$msg</h4>";
}
?>

<div id="container">
<?php include "headeradmin.php"; ?>
<article>
<section id="top">
<?php
$sql = "SELECT subject_name FROM subject 	WHERE subject_id = $subject_id";
$result = mysqli_query($link, $sql);
@$row = mysqli_fetch_array($result);
?>
	<h3>เพิ่มคำถามใหม่</h3>
    <span>หัวข้อ: <?php echo $row[0]; ?></span>
</section>

<section id="content">
<?php
//ถ้ากำหนดวันเวลาในการทำแบบทดสอบหัวข้อนี้เอาไว้ และขณะนั้นเลยวันเวลาที่กำหนดแล้ว
//จะไม่อนุญาตให้เพิ่มคำถามให้กับแบบทดสอบหัวข้อนี้ได้อีก
$sql = "SELECT CONCAT(date_test, ' ', date_start) FROM subject WHERE subject_id = $subject_id";
$result = mysqli_query($link, $sql);
@$row = mysqli_fetch_array($result);
$dt_test = strtotime($row[0]);
$now = strtotime("now");

if(($row[0] != "0000-00-00 00:00:00") && ($now >= $dt_test)) {
	echo '<h4 class="err">
	 				ขณะนี้เลยวันเวลาที่กำหนดในการทำแบบทดสอบหัวข้อนี้แล้ว<br>
					ดังนั้นจึงไม่อนุญาตให้เพิ่มคำถามในแบบทดสอบหัวข้อนี้อีก
			</h4>
			</section></article>';
	include "footer.php";
	echo '</div></body></html>';
	exit;
}
@mysqli_close($link);
?>
<?php echo $msg;  ?>
<form method="post" enctype="multipart/form-data">
	<label>คำถาม:</label><input type="text" name="question"><br>

    <input type="hidden" name="MAX_FILE_SIZE" value="1048576">
    <label>ไฟล์ภาพประกอบ(ถ้ามี):</label><input type="file" name="file"><br>
    <label></label>* ขนาดของไฟล์ต้องไม่เกิน 1 MB<br><br>

    <label>ตัวเลือกและคำตอบ:</label><input type="text" name="choice[1]" maxlength="250"><input type="radio" name="answer" value="1">(คำตอบ)<br>
    <label></label><input type="text" name="choice[2]" maxlength="250"><input type="radio" name="answer" value="2">(คำตอบ)<br>
    <label></label><input type="text" name="choice[3]" maxlength="250"><input type="radio" name="answer" value="3">(คำตอบ)<br>
    <label></label><input type="text" name="choice[4]" maxlength="250"><input type="radio" name="answer" value="4">(คำตอบ)<br>

    <div>
     	<button type="button" id="ok">ตกลง</button>
         <a href="index.php">ยกเลิก</a>
	</div>
    <input type="hidden" name="subject_id" value="<?php echo $subject_id; ?>">
</form>
</section>

</article>
<?php include "footer.php"; ?>
</div>
</body>
</html>
