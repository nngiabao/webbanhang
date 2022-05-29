<?php 
	$conn = mysqli_connect("localhost", "root", "", "web");  
	if(isset($_POST["username"])){
		$username = $_POST["username"];
		$oldpass = md5($_POST['oldpass']);
		$newpass = md5($_POST['newpass']);
		$query =  "select pass from user where username ='$username'";
		$result = mysqli_query($conn,$query);
		$row = mysqli_fetch_assoc($result);
		if($oldpass == $row['pass']){
			$query1 = "update user set pass ='$newpass' where username='$username'";
			mysqli_query($conn,$query1);
			mysqli_query($conn,'set names utf8');
			echo "Success";
		}else{
			echo "Fail";
		}
	}
?>