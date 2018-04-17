
<div class="container">
<div class="table-responsive">
  <form class="form" action="saveprofileuser.php" method="post">
<table class="table">

<tr>
  <th>รหัสผู้ใช้</th>
  <td>
    <div class="col-sm-8">
    <input name="txtmember_id" class="form-control" value="<?=$objResult["member_id"];?>" readonly/>
  </td>
  <th>สถานะ</th>
  <td>
    <div class="col-sm-8">
    <input name="txtlevel" class="form-control" value="<?=$objResult["level"];?>" readonly/>
  </td>
</tr>

<tr>
<th>ตำแหน่งที่คาดหวัง</th>
<td>
  <div class="col-sm-8">
  <input type="text" name="txtexpect_jobs" class="form-control" value="<?=$objResult["expect_jobs"];?>">
  </td>

<th>เงินเดือนที่คาดหวัง</th>
<td>
  <div class="col-sm-8">
<input type="text" name="txtsalary" maxlength="7" class="form-control" value="<?=$objResult["salary"];?>">
</td>
</tr>

<tr>
<th>Username</th>
<td>
  <div class="col-sm-8">
  <input type="text" name="txtusername" maxlength="20" class="form-control" value="<?=$objResult["username"];?>" readonly>
</td>
<th>Password</th>
<td>
  <div class="col-sm-8">
  <input type="password" name="txtpassword" id="txtpassword" maxlength="20" class="form-control" value="<?=$objResult["password"];?>">
</td>
</tr>

<tr>
<th>ชื่อ</th>
<td>
  <div class="col-sm-8">
  <input type="text" name="txtfirstname" class="form-control" value="<?=$objResult["firstname"];?>"></td>
<th>นามสกุล</th>
<td>
  <div class="col-sm-8">
  <input type="text" name="txtlastname" class="form-control" value="<?=$objResult["lastname"];?>"></td>
</tr>
<tr>
<th>อายุ</th>
<td><div class="col-sm-3">
<input type="text" name="txtage" maxlength="3" class="form-control" value="<?=$objResult["age"];?>"></td>
</tr>
<tr>
<th>ที่อยู่</th>
<td>
<textarea type="text" name="txtadr" class="form-control" value="<?=$objResult["adr"];?>" style="width:300px; height:100px;"><?=$objResult["adr"];?></textarea>
</td>
</tr>
<tr>
<th>ตำบล/แขวง</th>
<td>
<div class="col-sm-8">
<input type="text" name="txttamboon" class="form-control" value="<?=$objResult["tamboon"];?>">
</td>

<th>อำเภอ/เขต</th>
<td>
  <div class="col-sm-8">
  <input type="text" name="txtamphur" class="form-control" value="<?=$objResult["amphur"];?>">
  </td>
</tr>
<tr>
<th>จังหวัด</th>
  <td>
    <div class="col-sm-8">
          <input type="text" name="txtprov" value="<?=$objResult["prov"];?>" class="form-control">
    </div>
  </td>

<th>รหัสไปรษณีย์</th>
  <td>
    <div class="col-sm-8">
          <input type="text" name="txtpost_id" maxlength="5" value="<?=$objResult["post_id"];?>" class="form-control">
    </div>
  </td>
</tr>
<tr>

<th>เบอร์โทรศัพท์</th>
<td>
<div class="col-sm-8">
<input type="text" name="txtphone" maxlength="10" class="form-control" value="<?=$objResult["phone"];?>">
</td>

<th>E-Mail</th>
<td>
<div class="col-sm-8">
<input type="text" name="txtemail" class="form-control" value="<?=$objResult["email"];?>" >
</td>

</tr>

<tr>

<th>ทักษะทางภาษา</th>
<td>
<div class="col-sm-12">
<textarea type="text" name="txtlang" class="ckeditor" value="<?=$objResult["lang"];?>" > <?=$objResult["lang"];?> </textarea>
</td>

<th>ทักษะทางคอมพิวเตอร์</th>
<td>
<textarea type="text" name="txtcomputing" class="ckeditor" value="<?=$objResult["computing"];?>" > <?=$objResult["computing"];?> </textarea>
</td>

</tr>

<tr>

<th>ทักษะอื่นๆ</th>
<td>
<div class="col-sm-12">
<textarea type="text" name="txtother_skill" class="ckeditor" value="<?=$objResult["other_skill"];?>" > <?=$objResult["other_skill"];?> </textarea>
</td>

<th>ใบขับขี่รถยนต์</th>
<td>
<input type="radio" name="driving_license" value="yes" > มีใบขับขี่รถยนต์ <br>
<input type="radio" name="driving_license" value="no" checked> ไม่มีใบขับขี่รถยนต์
</td>
</tr>
</table>
<center>
<input type="submit" class="btn btn-info" role"button" name="Submit" value="Save">
<a href="user_page.php" class="btn btn-danger" role"button"> Cancel</a></center>
</form>
</div>
</div>
