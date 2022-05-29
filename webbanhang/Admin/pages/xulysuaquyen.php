<?php 
$username = $_POST["user"];
$idquyen = $_POST["idquyen"];

require("ConnectDB.php");
$sql = "update user set quyen = '$idquyen' where username = '$username'";
if(mysqli_query($con, $sql))
{
	echo "Sửa quyền thành công";
} else
{
	echo "Sửa quyền thất bại";
}


 ?>
