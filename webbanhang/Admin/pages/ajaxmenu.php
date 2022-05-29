<script src="https://code.jquery.com/jquery-latest.js"></script>
<?php
$act = $_POST["act"];
if($act == "qlsanpham")
{
	include("qlsanpham.php");
} else if($act == "qluser")
{
	include("qluser.php");
}
else if($act == "qldonhang")
{
	include("qldonhang.php");
}
else if($act == "khuyenmai")
{
	include("qlmagiam.php");
}
else if($act == "trangchu")
{
	include("trangchu.php");
}

?>