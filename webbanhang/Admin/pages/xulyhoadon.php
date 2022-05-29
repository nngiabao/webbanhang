<?php
require("ConnectDB.php");
$mahoadon = $_POST["mahoadon"];
//mysqli_query('set names utf8');
$sql123 = "SELECT * FROM hoadon where ma_hoadon ='$mahoadon'";
$rs123 = mysqli_query($con, $sql123);
$err = 0;
while ($row123 = mysqli_fetch_array($rs123))
{
	if($row123['trangthai'] == "Đã xử lý")
	{
		$err = 0;

	}
	if($row123['trangthai'] == "Chưa xử lý")
	{
		$err = 1;
	}
}
if($err == 1)
{
	
$sql = "SELECT * FROM chitiethoadon where ma_hoadon = '$mahoadon'";
$rs = mysqli_query($con, $sql);
while ($row = mysqli_fetch_array($rs))
{
	$soluong = $row["soluong"];
	$masp = $row["masp"];
	$tongthu = $row["thanhtien"];
	$sql2 = "UPDATE `sanpham` SET soluongdaban = soluongdaban + '$soluong' WHERE masp = '$masp'";
	$sql4 = "UPDATE `sanpham` SET tongthu = tongthu + '$tongthu' WHERE masp = '$masp'";
	mysqli_query($con, $sql2);
	mysqli_query($con, $sql4);
}
$sql3 = "update hoadon set trangthai = 'Đã xử lý' where ma_hoadon = '$mahoadon'";
mysqli_query($con, $sql3);
echo "Xử lý thành công";
} else if($err == 0)
{
	echo "Hóa đơn này đã xử lý";
}
?>