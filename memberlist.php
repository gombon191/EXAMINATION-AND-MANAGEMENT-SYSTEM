<?php
	session_start();
	if(@$_SESSION['member_id'] == "")
	{
    $alert = "กรุณาเข้าสู่ระบบ! หน้านี้สำหรับผู้ใช้ระดับ ผู้ดูแลเท่านั้น";
    echo "<script language=\"JavaScript\">";
    echo "alert('$alert');";
    echo "</script>";
		exit();
	}
	if(@$_SESSION['level'] != "ADMIN")
	{
		$alert = "หน้านี้สำหรับผู้ใช้ระดับ ผู้ดูแลเท่านั้น";
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
    <script src="./js/bootstrap.min.js"></script>
    <title>KHON KAEN BREWERY</title>

  </head>

  <body>
    <?php
  include "headeradmin.php";
     ?>

    <br><br>
    <br><br>
    <?php
          include "connectdb.php";

        $sql = "SELECT * FROM resume";

        $query = mysqli_query($link,$sql);
      ?>

      <table class="table table-striped" width="auto" >
        <tr>
          <th> <div align="center">รหัสผู้ใช้</th>
          <th> <div align="center">Username</th>
          <th> <div align="center">Password</th>
          <th> <div align="center">สถานะ</th>
          <th> <div align="center">ชื่อ</th>
          <th> <div align="center">นามสกุล</th>
          <th> <div align="center">อายุ</th>
          <th> <div align="center">ที่อยู่</th>
          <th> <div align="center">เบอร์มือถือ</th>
          <th> <div align="center">อีเมล์</th>
          <th> <div align="center">งานที่คาดหวัง</th>
          <th> <div align="center">เงินเดือนที่คาดหวัง</th>
          <th> <div align="center">ทักษะทางภาษา</th>
          <th> <div align="center">ทักษะทางคอมพิวเตอร์</th>
          <th> <div align="center">ทักษะด้านอื่นๆ</th>
          <th> <div align="center">ใบขับขี่รถยนต์</th>
          <th> <div align="center">แก้ไข</th>
					<th> <div align="center">ลบ</th>
        </tr>
<?php
      while  ($result=mysqli_fetch_array($query,MYSQL_ASSOC))
 {
 ?>
 <tr>
   <td><div align="center"><?php echo $result["member_id"];?></div></td>
   <td><div align="center"><?php echo $result["username"];?></div></td>
   <td><div align="center"><?php echo $result["password"];?></div></td>
   <td><div align="center"><?php echo $result["level"];?></div></td>
   <td><div align="center"><?php echo $result["firstname"];?></div></td>
   <td><div align="center"><?php echo $result["lastname"];?></div></td>
   <td><div align="center"><?php echo $result["age"];?></div></td>
   <td><div align="center"><?php echo $result["adr"];?></div></td>
   <td><div align="center"><?php echo $result["phone"];?></div></td>
   <td><div align="center"><?php echo $result["email"];?></div></td>
   <td><div align="center"><?php echo $result["expect_jobs"];?></div></td>
   <td><div align="center"><?php echo $result["salary"];?></div></td>
   <td><div align="center"><?php echo $result["lang"];?></div></td>
   <td><div align="center"><?php echo $result["computing"];?></div></td>
   <td><div align="center"><?php echo $result["other_skill"];?></div></td>
   <td><div align="center"><?php echo (($result["driving_license"] == '')? "มี" : "ไม่มี");?></div></td>
   <td align="center"><a href="edituser.php?member_id=<?php echo $result["member_id"];?>" class="btn btn-info"><span class="glyphicon glyphicon-pencil"></span></a></td>
	 <td align="center">
<a href="JavaScript:if(confirm('Confirm Delete?') == true){window.location='deletememberlist.php?member_id=<?php echo $result["member_id"];?>';}" class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span></a>
 </tr>
 <?php
}
  ?>
      </table>
      <?php
          mysqli_close($link);
        ?>
        <br>
        </body>
        <?php include "footer.php"; ?>
        </html>
