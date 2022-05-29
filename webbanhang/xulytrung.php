<?php
	$conn = mysqli_connect("localhost", "root", "", "web");  
	if(isset($_POST['username'])){
		$query = "select * from user where username = '".$_POST['username']."'";
		$result = mysqli_query($conn,$query);
		if(mysqli_num_rows($result) > 0){
			echo 'username cant use';
		}else{
			echo 'username can use';
		}
	}

	if(isset($_POST['email'])){
		$query = "select * from user where email = '".$_POST['email']."'";
		$result = mysqli_query($conn,$query);
		if(mysqli_num_rows($result) > 0){
			echo 'email cant use';
		}else{
			echo 'email can use';
		}
	}

	if(isset($_POST['magg'])){
		$query = "select * from magiamgia where tenmagiamgia = '".$_POST['magg']."'";
		$result = mysqli_query($conn,$query);
		mysqli_query($conn, 'set names utf8');
		$a = mysqli_num_rows($result);
		$row = mysqli_fetch_array($result);
		if($_POST['magg'] == $row['tenmagiamgia']){
			echo $row['sotiengiam'];
		}else{
			echo 0;
		}
	}

?>