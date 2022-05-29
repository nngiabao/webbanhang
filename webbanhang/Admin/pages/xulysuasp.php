
<?php
require("ConnectDB.php");

$filename = $_FILES['file']['name'];
$tensp = $_POST["tensp"];
$masp = $_POST["masp"];
$loaisp = $_POST["loaisp"];
$motasp = $_POST["motasp"];
$giasp = $_POST["giasp"];
$location = "img/".$filename;
$date = date('Y-m-d');

//lay ngày hiện tại

$sql = "update sanpham set tensp = '$tensp', anhsp = '$location', mota = '$motasp',gia = '$giasp',ngaydang = '$date',trangthai ='1',id_con = '$loaisp' where masp ='$masp'";
$rs = mysqli_query($con, $sql);
if($rs == true)
{
	echo "Sửa sản phẩm thành công";
}
else
{
	echo "Sửa sản phẩm thất bại";
}
move_uploaded_file($_FILES['file']['tmp_name'], $location);
?>