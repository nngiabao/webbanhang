<?php 
	session_start();
 	$conn = mysqli_connect("localhost", "root", "", "web");  
	if(isset($_POST['username'])){
		$mahd = $_POST['mahd'];
		$username = $_POST['username'];
		$diachi = $_POST['diachi'];
		$ghichu = $_POST['ghichu'];
		$tongtien1 = $_POST['tongtien1'];
		$tongtien2 = $_POST['tongtien2'];
		$ngaylap = date("y-m-d");
		$trangthai = 'Chưa xử lý';
		$magg = $_POST['magg'];
		
		$query = "insert into hoadon(ma_hoadon,username,diachigiaohang,ghichu,tongtienbandau,magiamgia,tongtiensaukhigiam,ngaylap,trangthai) values ('$mahd','$username','$diachi','$ghichu','$tongtien1','$magg','$tongtien2','$ngaylap','$trangthai')";
		mysqli_query($conn,$query);
		mysqli_query($conn,'set names utf8');
	 	echo("hello");
		foreach($_SESSION["giohang"] as $keys => $values){
		   $hoadon = array(
			    'masp' => $values['masp'],
				'soluong' => $values["soluong"],
				'giasp' => $values["giasp"],
		   		'thanhtien' => $values["giasp"]*$values["soluong"]
		   );
			$masp = $hoadon["masp"];
			$soluong = $hoadon["soluong"];
			$giasp = $hoadon["giasp"];
			$thanhtien = $hoadon["thanhtien"];
			$query1 = "insert into chitiethoadon(ma_hoadon,masp,soluong,dongia,thanhtien) values ('$mahd','$masp','$soluong','$giasp','$thanhtien')";
			mysqli_query($conn,$query1);
			mysqli_query($conn,'set names utf8');
			unset($_SESSION["giohang"]);
		}
	}
?>