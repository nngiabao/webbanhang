<?php
	session_start();
 	$conn = mysqli_connect("localhost", "root", "", "web");  
	if(isset($_POST['username'])){
		$query = "select * from user where username = '".$_POST['username']."' and pass = '".md5($_POST['password'])."'";
		$query1 = "update user set trangthai='Online' where username = '".$_POST['username']."'";
		$result = mysqli_query($conn,$query);
		$row = mysqli_fetch_array($result);
		if(mysqli_num_rows($result) > 0){
			$_SESSION['username'] = $_POST['username'];
			mysqli_query($conn,$query1);
			if($row['quyen'] == 1 || $row['quyen'] == 2 || $row['quyen'] == 3){
				echo 1; 
			}else{
				echo 'Success';
			}
		}else{	
			echo 0;
		}
	}

	if(isset($_POST["action"]))  
 	{  
	 $query2 = "update user set trangthai='Offline' where username = '".$_POST['username']."'";	
	 mysqli_query($conn,$query2);
      unset($_SESSION["username"]);  
 	}  
 ?>  
