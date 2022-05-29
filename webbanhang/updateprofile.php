<?php
	$conn = mysqli_connect("localhost", "root", "", "web");  
	
	if(isset($_POST["username"])){
		$query = "select * from user where username = '".$_POST['username']."'";
		$result = mysqli_query($conn,$query);
		$row = mysqli_fetch_array($result);
		echo json_encode($row);
	}
	
	if(isset($_POST["action"])){
		$hoten = $_POST['name'];
		$username = $_POST['username'];
		$ngaysinh = $_POST['dob'];
		$sdt = $_POST['phone'];
		$gioitinh = $_POST['sex'];
		$query1 = "update user set hoten ='$hoten',ngaysinh='$ngaysinh',sodienthoai='$sdt',gioitinh = '$gioitinh' where username = '$username'";
		mysqli_query($conn,$query1);
	}
?>