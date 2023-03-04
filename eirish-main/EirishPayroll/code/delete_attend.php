<?php
include('connection.php');

if(isset($_POST['checkbox'])){
	foreach($_POST['checkbox'] as $list){
		$id=mysqli_real_escape_string($con,$list);
		if(mysqli_query($con, $query)){
			$run = mysqli_query($con,"DELETE FROM `archive_attendancee` WHERE `id`='$id'");
		} else{
			echo "Error: ".mysqli_error($con);  
		} 
	}
	echo "<script>" . "window.location.href='trash_attendance.php';" . "</script>"; 
}
?>
