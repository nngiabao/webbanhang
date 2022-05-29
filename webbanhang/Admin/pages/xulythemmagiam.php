
<?php
require("ConnectDB.php");


$magiam = $_POST["magiam"];
$tiengiam = $_POST["tiengiam"];
$ngaybatdau = $_POST["ngaybatdau"];
$ngayketthuc = $_POST["ngayketthuc"];


$sql1 = "select * from magiamgia";
$rss = mysqli_query($con, $sql1);
$err = false;
while ($row = mysqli_fetch_array($rss)) 
{
	if($magiam == $row["tenmagiamgia"])	
	{
		echo "Mã giảm đã tồn tại";
		$err = false;
	}
	else
	{
		$err = true;
	}
}
if($err == true)
{
	$sql = "Insert into magiamgia values ('$magiam','$tiengiam','$ngaybatdau','$ngayketthuc','1')";
	$rs = mysqli_query($con, $sql);
	if($rs == true)
{
	echo "Thêm mã giảm giá thành công";
}

}

?>