<meta charset="utf-8">
<?php 
include("condb.php");

//print_r($_POST);

 	//save workin
 	if(isset($_POST["workin"])){

		 	$workdate = date('Y-m-d');
			$m_id = mysqli_real_escape_string($condb,$_POST["m_id"]);
			$workin = mysqli_real_escape_string($condb,$_POST["workin"]);

			$sql = "INSERT INTO tbl_work_io
			(workdate, m_id, workin)
			VALUES
			('$workdate', '$m_id', '$workin')";
			$result = mysqli_query($condb, $sql) or die ("Error in query: $sql " . mysqli_error($sql));

					mysqli_close($condb);
					if($result){
					echo "<script type='text/javascript'>";
					echo "alert('บันทึกข้อมูลสำเร็จ');";
					echo "window.location = 'profile.php'; ";
					echo "</script>";
					}else{
					echo "<script type='text/javascript'>";
					echo "alert('Error');";
					echo "window.location = 'profile.php'; ";
					echo "</script>";
					}

		//save workout			
 	}elseif(isset($_POST["workout"])) {

 		// echo $_POST["workout"];

 		// exit;

 			$workdate = date('Y-m-d');
 		    $m_id = mysqli_real_escape_string($condb,$_POST["m_id"]);
			$workout = mysqli_real_escape_string($condb,$_POST["workout"]);

			$sql2 = "UPDATE tbl_work_io SET 
			workout='$workout'
			WHERE m_id=$m_id  AND workdate='$workdate'
			";
			$result2 = mysqli_query($condb, $sql2) or die ("Error in query: $sql2 " . mysqli_error($sql2));

			// echo $sql2;
			// exit;

					mysqli_close($condb);
					if($result2){
					echo "<script type='text/javascript'>";
					echo "alert('บันทึกข้อมูลสำเร็จ');";
					echo "window.location = 'profile.php'; ";
					echo "</script>";
					}else{
					echo "<script type='text/javascript'>";
					echo "alert('Error');";
					echo "window.location = 'profile.php'; ";
					echo "</script>";
					}
 		 
 	} //}elseif (isset(($_POST["workout"])) {
 else{
 			echo "<script type='text/javascript'>";
 			echo "alert('คุณได้บันทึกเวลาเข้า-ออกงานวันนี้เรียบร้อยแล้ว');";
			echo "window.location = 'profile.php'; ";
			echo "</script>";
 }	
?>