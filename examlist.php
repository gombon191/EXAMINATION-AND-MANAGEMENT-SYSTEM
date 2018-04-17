<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="css/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="./js/bootstrap.min.js"></script>
    <title>KHON KAEN BREWERY</title>
    <style>
    * {
    font: 14px tahoma;
    }
    body {
    background: url(img/bg.jpg);
    text-align: center;
    min-width: 700px;
    }
    table {
    border-collapse: collapse;
    min-width: 600px;
    margin: auto;
    }
    td {
    text-align: left;
    }
    td, th {
    padding: 5px;
    border-right: solid 1px white;
    font: 14px tahoma;
    word-wrap:break-word;
    vertical-align: top;
    max-width: 250px;
    }
    td:last-child, th:last-child {
    border-right: solid 0px !important;
    }
    tr:nth-of-type(odd) {
    background: #dfd;
    }
    tr:nth-of-type(even) {
    background: #ddf;
    }
    th {
    background: #ecd013 !important;
    color: yellow;
    }
    a {
    text-decoration: none;
    color: blue;
    }
    a:hover {
    color:red;
    }
    caption {
    text-align: left;
    padding: 2px;
    }
    button {
    background: steelblue;
    color: white;
    border:solid 1px orange;
    border-radius: 3px;
    padding: 2px 10px;
    }
    img {
    height: 20px;
    vertical-align: text-top;
    }
    </style>

  </head>

  <body>
    <header>
    <nav class="navbar navbar-fixed-top navbar-expand-lg" id="Nav">
      <div class="container">
        <ul class="nav navbar-nav navbar-left">
          <a class="navbar-brand" href="index.php"><span class="glyphicon glyphicon-home"></span> <b>  RecruitWebQuiz</b></a>
        </ul>
            <ul class="nav navbar-nav navbar-right">
              <li><a href="about.php"><span class="glyphicon glyphicon-tasks"></span> เกี่ยวกับ</a></li>
              <li><a href="contact.php"><span class="glyphicon glyphicon-earphone"></span> ติดต่อเรา</a></li>
              <li><a href="rule.php"><span class="glyphicon glyphicon-list-alt"></span> ขั้นตอนการสอบ</a></li>
            </ul>
      </div>
    </nav>
    </header>

    <br><br><br><br>

<?php
include "connectdb.php";

$sql = "SELECT * FROM examset";

$r_set = mysqli_query($link, $sql);

if($_POST) {
  $qu_id = implode(",", $_POST['qu_id']);
  $sql = "DELETE FROM examquest WHERE qu_id IN($qu_id)";
  mysqli_query($link, $sql);
}

$sql = "SELECT * FROM examquest";
$result = mysqli_query($link, $sql);

echo "<table><caption>";
echo '<img src="img/arrow-down.gif"><button>ลบแถวที่เลือก</button>
<a href= "formexam.php?action=insert">เพิ่มข้อมูล</a></caption>';
echo "<tr>";
$num_fields = mysqli_num_fields($result);
echo "<th>&nbsp;</th>";
echo "<th>action</th>";
for($i = 0; $i < $num_fields; $i++) {
  $f = mysqli_fetch_field_direct($result, $i);
  echo "<th>".$f->name."</th>";
}
echo "</tr>";
while($data = mysqli_fetch_array($result)) {
echo  "<tr>";
echo '<td><input type="checkbox" name="qu_id" value="'.$data['qu_id'].'"></td>';
echo "<td>
    <a href=\"formexam.php?action=update&id={$data['qu_id']}\">แก้ไข</a> |
    <a href=\"formexam.php?action=delete&id={$data['qu_id']}\">ลบ</a>
  </td>";

  for($i = 0; $i < $num_fields; $i++) {
    echo "<td>".$data[$i]."</td>";
  }
  echo "</tr>";
}
echo "</table>";
mysqli_close($link);
 ?>
 <br> <br> <br> <br> <br>

 <div class="footer navbar-fixed-bottom">
       <footer>
         <p class="text-center">เยี่ยมชมเว็บไซต์ บริษัท ขอนแก่น บริวเวอรี่ จำกัด <a href="http://kkb.boonrawd.co.th/th/index">คลิก</a>
           <br> © 2016 singha corporation co., ltd. all rights reserved.</p>
       </footer>
 </div>
 </body>
 </html>
