<script src="https://code.jquery.com/jquery-latest.js"></script>

<?php
	require ("ConnectDB.php");
	$act = $_POST["act"];//lay mã sản phẩm
	$sql = "UPDATE `sanpham` SET trangthai=0 WHERE masp ='".$act."'";
	
	mysqli_query($con, $sql);
?>
