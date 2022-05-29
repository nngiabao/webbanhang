<?php
	$conn = mysqli_connect("localhost", "root", "", "web");  
	if(isset($_POST['username'])){
		$username  = $_POST['username'];
		$password =  $_POST['password'];
		$hoten = $_POST['name'];
		$email = $_POST['email'];;
		$gioitinh = $_POST['sex'];	 
		$sdt = $_POST['phone'];
		$ngaylap = date('y-m-d');
		$password = md5($password);
		$ngaysinh = $_POST['dob'];
		$quyen = 4;
		$trangthai= 'Offline';

		//echo $username ,$password,$hoten,$email,$sdt,$ngaysinh ,$gioitinh;
		$query = "insert into user(username,pass,hoten,email,sodienthoai,ngaysinh,gioitinh,quyen,ngaylap,trangthai) values ('$username','$password','$hoten','$email','$sdt','$ngaysinh','$gioitinh','$quyen','$ngaylap','$trangthai')";
		mysqli_query($conn,$query);
		mysqli_query($conn,'set names utf8');
	}
?>