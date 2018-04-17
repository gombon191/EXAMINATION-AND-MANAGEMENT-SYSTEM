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
		<?php
$objConnect = mysql_connect("localhost","root","") or die("Error Connect to Database");
$objDB = mysql_select_db("webquiz");
$strSQL = "SELECT * FROM resume";
$objQuery = mysql_query($strSQL) or die ("Error Query [".$strSQL."]");
?>
    <br>
    <br>
    <br><br>
    <div class="container">
    <div class="table-responsive">
<form class="form" action="register_save.php" method="post">
<table class="table">

    <tr>
    <th>ตำแหน่งที่คาดหวัง</th>
    <td>
      <div class="col-sm-8">
      <input type="text" name="txtexpect_jobs" class="form-control" id="txtexpect_jobs">
      </td>

    <th>เงินเดือนที่คาดหวัง</th>
    <td>
      <div class="col-sm-8">
    <input type="text" name="txtsalary" maxlength="7" class="form-control" id="txtsalary">
    </td>
    </tr>

    <tr>
    <th>Username</th>
    <td>
      <div class="col-sm-8">
      <input type="text" name="txtusername" maxlength="20" class="form-control" id="txtusername">
    </td>
    <th>Password</th>
    <td>
      <div class="col-sm-8">
      <input type="password" name="txtpassword" maxlength="20" class="form-control" id="txtpassword">
    </td>
  </tr>

    <tr>
    <th>ชื่อ</th>
    <td>
      <div class="col-sm-8">
      <input type="text" name="txtfirstname" class="form-control" id="txtfirstname"></td>
    <th>นามสกุล</th>
    <td>
      <div class="col-sm-8">
      <input type="text" name="txtlastname" class="form-control" id="txtlastname"></td>
  </tr>
  <tr>
  <th>อายุ</th>
  <td><div class="col-sm-3">
    <input type="text" name="txtage" maxlength="3" class="form-control" id="txtage"></td>
    <th>สถานะ</th>
    <td>
      <input type="radio" name="level" id="level" value="USER" checked> ผู้สอบ
    </td>
</tr>
<tr>
<th>ที่อยู่</th>
<td>
  <textarea type="text" name="txtadr" class="form-control" id="txtadr" style="width:300px; height:100px;"></textarea>
  </td>
</tr>
<tr>
  <th>ตำบล</th>
  <td>
    <div class="col-sm-8">
    <input type="text" name="txttamboon" class="form-control" id="txttamboon">
    </td>

    <th>อำเภอ</th>
    <td>
      <div class="col-sm-8">
      <input type="text" name="txtamphur" class="form-control" id="txtamphur">
      </td>
</tr>
<tr>
  <th>จังหวัด</th>
      <td>
        <div class="col-sm-8">
              <input type="text" name="txtprov" class="form-control" id="txtprov">
        </div>
      </td>

  <th>รหัสไปรษณีย์</th>
      <td>
        <div class="col-sm-8">
              <input type="text" name="txtpost_id" class="form-control" id="txtpost_id" maxlength="5">
        </div>
      </td>
</tr>
<tr>

<th>เบอร์โทรศัพท์</th>
<td>
  <div class="col-sm-8">
  <input type="text" name="txtphone" maxlength="10" class="form-control" id="txtphone">
  </td>

<th>E-Mail</th>
  <td>
    <div class="col-sm-8">
    <input type="text" name="txtemail" class="form-control" id="txtemail">
    </td>

</tr>

<tr>

<th>ทักษะทางภาษา</th>
<td>
  <div class="col-sm-12">
  <textarea type="text" name="txtlang" class="ckeditor" id="txtlang"></textarea>
  </td>

<th>ทักษะทางคอมพิวเตอร์</th>
  <td>
    <textarea type="text" name="txtcomputing" class="ckeditor" id="txtcomputing"></textarea>
    </td>

</tr>

<tr>

<th>ทักษะอื่นๆ</th>
<td>
  <div class="col-sm-12">
  <textarea type="text" name="txtother_skill" class="ckeditor" id="txtother_skill"></textarea>
  </td>

<th>ใบขับขี่รถยนต์</th>
  <td>
    <input type="radio" name="driving_license" value="yes" > มีใบขับขี่รถยนต์ <br>
		<input type="radio" name="driving_license" value="no" checked> ไม่มีใบขับขี่รถยนต์
    </td>
</tr>
</table>
<hr>
<center>
<input type="submit" class="btn btn-info" role"button" name="Submit" value="Save"></center>
</form>
</div>
</div>
<br>
<br>
<br>
  </body>
<?php include "footer.php"; ?>
</html>
