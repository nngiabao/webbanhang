
<?php
require("ConnectDB.php");


$magiam = $_POST["magiam"];
$tiengiam = $_POST["tiengiam"];
$ngaybatdau = $_POST["ngaybatdau"];
$ngayketthuc = $_POST["ngayketthuc"];

//lay ngày hiện tại
$sql = "update magiamgia set sotiengiam = '$tiengiam', ngaybatdau ='$ngaybatdau', ngayketthuc ='$ngayketthuc' where tenmagiamgia = '$magiam'";
$rs = mysqli_query($con, $sql);
if($rs == true)
{
	echo "Sửa mã giảm giá thành công";
}
else
{
	echo "Sửa mã giảm giá thất bại";
}
?>