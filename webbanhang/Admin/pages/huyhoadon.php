<script src="https://code.jquery.com/jquery-latest.js"></script>

<?php
	require ("ConnectDB.php");
	$act = $_POST["act"];//lay mã sản phẩm


$sql = "SELECT * FROM chitiethoadon where ma_hoadon = '$act'";
$rs = mysqli_query($con, $sql);
while ($row = mysqli_fetch_array($rs))
{
	$soluong = $row["soluong"];
	$masp = $row["masp"];
	$sql2 = "UPDATE `sanpham` SET soluongdaban = soluongdaban - '$soluong' WHERE masp = '$masp'";
	mysqli_query($con, $sql2);
}
	$sql1 = "delete from hoadon where ma_hoadon='$act'";
	mysqli_query($con, $sql1);
?>
