<script src="https://code.jquery.com/jquery-latest.js"></script>

<?php
	require ("ConnectDB.php");
	$act = $_POST["act"];//lay mã sản phẩm
	$sql = "update `magiamgia` set trangthai ='0' WHERE tenmagiamgia ='".$act."'";
	
	mysqli_query($con, $sql);
?>