<?php
include('connection.php');

if(isset($_POST['checkbox'])){
	foreach($_POST['checkbox'] as $list){
		$id=mysqli_real_escape_string($con,$list);
		$query= "INSERT INTO `employee` (`id`, `emp_id`, `name`, `address`, `position`, `rate`, `phonenumber`, `sex`, `civil_status`, `emergency_name`, `emergency_contact`) SELECT  `id`, `emp_id`, `name`, `address`, `position`, `rate`, `phonenumber`, `sex`, `civil_status`, `emergency_name`, `emergency_contact` FROM `employee` WHERE `id` = '$id'";

		if(mysqli_query($con, $query)){
			$run = mysqli_query($con,"DELETE FROM `archive` WHERE `id`='$id'");
		} else{
			echo "Error: ".mysqli_error($con);  
		} 
	}
	echo "<script>" . "window.location.href='trash.php';" . "</script>"; 
}
?>
