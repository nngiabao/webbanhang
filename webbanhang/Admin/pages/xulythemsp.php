
<?php
require("ConnectDB.php");

$filename = $_FILES['file']['name'];
$tensp = $_POST["tensp"];
$masp = $_POST["masp"];
$loaisp = $_POST["loaisp"];
$motasp = $_POST["motasp"];
$giasp = $_POST["giasp"];
$location = "../../img/".$filename;
$date = date('Y-m-d');
//lay ngày hiện tại
$sql3 = "select * from sanpham";
$rss = mysqli_query($con, $sql3);
$err = false;
while ($row = mysqli_fetch_array($rss)) 
{
	if($masp == $row["masp"])
	{
		echo "Mã sản phẩm đã tồn tại";
		$err = false;
	}
	else
	{
		$err = true;
	}
}
if($err == true)
{
$sql = "Insert into sanpham values ('$masp','$tensp','$location','$motasp','$giasp','$date','1','$loaisp','0','0')";
$rs = mysqli_query($con, $sql);
if($rs == true)
{
	echo "Thêm sản phẩm thành công";
}
move_uploaded_file($_FILES['file']['tmp_name'], $location);
}

?>