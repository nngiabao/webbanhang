<?php
	$conn = mysqli_connect("localhost", "root", "", "web");  
	if(isset($_POST['username'])){
		$query = "select * from user where username = '".$_POST['username']."'";
		$result = mysqli_query($conn,$query);
		$output = "";
		$output .= 
			'<div class="table-responsive">
			<table class="table-bordered table">';
		while($row = mysqli_fetch_array($result)){
			$output .= 
			'<tr>
				<td><label>Tài khoản</label></td>
				<td>'.$row['username'].'</td>
			</tr>
			<tr>
				<td><label>Họ tên</label></td>
				<td>'.$row['hoten'].'</td>
			</tr>
			<tr>
				<td><label>Email</label></td>
				<td>'.$row['email'].'</td>
			</tr>
			<tr>
				<td><label>Số điện thoại</label></td>
				<td>'.$row['gioitinh'].'</td>
			</tr>
			<tr>
				<td><label>Ngày sinh</label></td>
				<td>'.$row['ngaysinh'].'</td>
			</tr>
			<tr>
				<td><label>Giới tính</label></td>
				<td>'.$row['gioitinh'].'</td>
			</tr>';
		}
		$output.= '</table></div>';
		echo $output;
	}
?>