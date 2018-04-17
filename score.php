<?php
include "check_user.php";
?>
<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link rel="stylesheet" type="text/css" href="css/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="./js/bootstrap.min.js"></script>
	<title>KHON KAEN BREWERY</title>

<style>
	@import "global.css";
	table {
		border-collapse: collapse;
		margin: 15px auto 20px;
	}
	tr {
		border-bottom: solid 1px white;
	}
	th {
		background: lightblue;
		text-align: left;
	}
	th:nth-child(1) {
		width: 250px;;
	}
	th:nth-child(2) {
		width: 450px;
	}
	tr > *:nth-child(3), tr > *:nth-child(4) {
		width: 80px;
		text-align: center;
	}
	th, td {
		padding: 5px 1px;
		vertical-align: top;
	}
	tr:nth-of-type(odd) {
		background-color: #ddd;
	}
	tr:nth-of-type(even) {
		background-color: #cfc;
	}
</style>

<script src="js/jquery-2.1.1.min.js"></script>
<script>
$(function() {

});
</script>
</head>

<body>
	<br><br><br>
<div id="container">
<?php include "headeruser.php"; ?>
<article>

<section id="top">
	<h3>ผลคะแนน</h3>
    <span>ตามจำนวนข้อที่ทำถูก</span>
</section>

<section id="content">
<table>
<tr><th>ชื่อ</th><th>หัวข้อแบบทดสอบ</th><th>คำถาม</th><th>คะแนน</th></tr>
<?php
include "connectdb.php";
$member_id = $_SESSION['member_id'];
$sql = "SELECT * FROM score WHERE ";

$tid = 1;
if(isset($_SESSION['member_id'])) {
	$tid = " member_id = {$_SESSION['member_id']}";
}
$sub = 1;
if(isset($_GET['subject_id'])) {
	$sub = " subject_id = {$_GET['subject_id']}";
}
$sql .= $tid . " AND " . $sub;

$result = mysqli_query($link, $sql);
while($data = mysqli_fetch_array($result)) {
	$sql = "SELECT CONCAT(firstname, '  ', lastname) FROM resume WHERE  member_id = {$data['member_id']}";
	$r = mysqli_query($link, $sql);
	$row = mysqli_fetch_array($r);
	$name = $row[0];

	$subject_id = $data['subject_id'];
	$sql = "SELECT COUNT(*) FROM question WHERE subject_id = $subject_id";
	$r = mysqli_query($link, $sql);
	$row = mysqli_fetch_array($r);
	$questions = $row[0];

	$sql = "SELECT subject_name FROM subject WHERE subject_id = $subject_id";
	$r = mysqli_query($link, $sql);
	$row = mysqli_fetch_array($r);
	$subject = $row[0];

	echo "<tr>
				<td>$name</td><td>$subject</td><td>$questions</td><td>{$data['amount']}</td>
			</tr>";
}
mysqli_close($link);
?>
</table>
</section>

</article>
<?php include "footer.php"; ?>
</div>
</body>
</html>
