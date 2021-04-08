<?php
session_start();
// echo '<pre>';
        // print_r($_SESSION);
// echo '</pre>';
include('condb.php');
$m_id = $_SESSION['m_id'];
$m_level = $_SESSION['m_level'];
if($m_level!='staff'){
Header("Location: logout.php");
}
//query member login
$queryemp = "SELECT * FROM tbl_emp WHERE m_id=$m_id";
$resultm = mysqli_query($condb, $queryemp) or die ("Error in query: $queryemp " . mysqli_error($condb));
$rowm = mysqli_fetch_array($resultm);
//เวลาปัจจุบัน
$timenow = date('H:i:s');
$datenow = date('Y-m-d');
//เวลาที่บันทึก
$queryworkio = "SELECT MAX(workdate) as lastdate, workin, workout FROM tbl_work_io WHERE m_id=$m_id AND workdate='$datenow' ";
$resultio = mysqli_query($condb, $queryworkio) or die ("Error in query: $queryworkio " . mysqli_error($condb));
$rowio = mysqli_fetch_array($resultio);
print_r($rowio);
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <title>ระบบบันทึกเวลาการทำงาน by devbanban.com</title>
  </head>
  <body>
    <div class="container">
      <div class="row">
        <div class="col col-sm-12">
          <h3  class="jumbotron" align="center">Work-IO ระบบบันทึกเวลาการทำงาน by devbanban.com </h3>
        </div>
      </div>
    </div>
    <div class="container">
      <div class="row">
        <div class="col col-sm-3">
          <img src="img/<?php echo $rowm['m_img'];?>" width='70%'>
          <br>
          <b>
          <?php echo $rowm['m_firstname'].$rowm['m_name']. ' '.$rowm['m_lastname'];?>
          <br>
          ตำแหน่ง : <?php echo $rowm['m_position'];?>
          </b>
          <br>
          <a href="logout.php" class="btn btn-danger btn-sm"> logout </a>
        </div>
        <div class="col col-sm-9">
          <h3> ลงเวลาเข้า-ออกงาน <?php echo date('d-m-Y');?></h3>
          <form action="save.php"  method="post" class="form-horizontal">
            <div class="form-group row">
              <div class="col col-sm-2">
                <label for="m_id">รหัสพนักงาน</label>
                <input type="text" class="form-control"   name="m_id"   placeholder="รหัสพนักงาน"   value="<?php echo $rowm['m_id'];?>"  readonly>
              </div>
              <div class="col col-sm-3">
                <label for="m_id">เวลาเข้างาน</label>
                <?php if(isset($rowio['workin'])){ ?>
                <input type="text" class="form-control"   name="workin"   value="<?php echo $rowio['workin'];?>"  disabled>
                <?php }else{ ?>
                <input type="text" class="form-control"   name="workin"   value="<?php echo date('H:i:s');?>"  readonly>
                <?php  } ?>
              </div>
              <div class="col col-sm-3">
                <label for="m_id">เวลาออกงาน</label>
                <?php
                if($timenow > '17:00:00'){
                if(isset($rowio['workout'])){ ?>
                <input type="text" class="form-control"   name="workout"  value="<?php echo $rowio['workout'];?>"  disabled>
                <?php }else{ ?>
                <input type="text" class="form-control"   name="workout"  value="<?php echo date('H:i:s');?>"  readonly>
                <?php
                } //if(isset($rowio['workout'])){
                }else{  //if($timenow > '11:00:00'){
                echo '<br><font color="red"> หลัง 17.00 น. </font>';
                } ?>
              </div>
              <div class="col col-sm-1">
                <label>-</label>
                <button type="submit" class="btn btn-primary">บันทึก</button>
              </div>
            </div>
          </form>
          <h3>List</h3>
          <?php
          $querylist = "SELECT * FROM tbl_work_io WHERE m_id = $m_id ORDER BY workdate DESC";
          $resultlist = mysqli_query($condb, $querylist)  or die ("Error:" . mysqli_error($condb));
          echo "
          <table class='table table-bordered table-striped'>
          <thead>
            <tr class='table-danger'>
              <td>date</td>
              <td>work-in</td>
              <td>work-out</td>
            </tr>
            </thead>
            ";

            foreach ($resultlist as $value) {
            echo "<tr>";
              echo "<td>" .$value["workdate"] .  "</td> ";
              echo "<td>" .$value["workin"] .  "</td> ";
              echo "<td>" .$value["workout"] .  "</td> ";
            echo "</tr>";
            }
          echo '</table>';
          ?>
        </div>
      </div>
    </div>
    <div class="container-fluid" style="margin-top: 100px;">
      <div class="row">
        <div class="col col-sm-12">
          <p align="center"> *เป็นระบบตัวอย่าง สำหรับเอาไปพัฒนาต่อยอดนะครับ <br>
            <a href="https://devbanban.com/" target="_blank">
              https://devbanban.com/
            </a></p>
          </div>
        </div>
      </div>
      <!-- Optional JavaScript -->
      <!-- jQuery first, then Popper.js, then Bootstrap JS -->
      <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
      <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
      <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    </body>
  </html>
