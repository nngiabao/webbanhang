<?php
$username = $_POST["user"];

require("ConnectDB.php");
$sql = "select * from user where username = '$username'";
$rs = mysqli_query($con, $sql);
$quyen = "";
while ($row = mysqli_fetch_array($rs)) 
{
	if($row["quyen"] == 3)
	{
		$quyen = "Nhân viên";
	}
	if($row["quyen"] == 4)
	{
		$quyen = "Khách hàng";
	}
}
?>
<style type="text/css">
  .selectWrapper {
    width: 150px;
    overflow: hidden;
    position: relative;
    border: 1px solid #bbb;
    border-radius: 2px;
    background:#FFFFFF url('data:image/svg+xml,%3Csvg%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20width%3D%2211%22%20height%3D%2211%22%20viewBox%3D%220%200%2011%2011%22%3E%3Cpath%20d%3D%22M4.33%208.5L0%201L8.66%201z%22%20fill%3D%22%2300AEA9%22%2F%3E%3C%2Fsvg%3E') right 13px center no-repeat;
}

.selectWrapper select {
        padding: 12px 40px 12px 20px;
        font-size: 18px;
        line-height: 18px;
        width: 100%;
        border: none;
        box-shadow: none;
        background: transparent;
        background-image: none;
        -webkit-appearance: none;
        outline: none;
        cursor: pointer;
        -moz-appearance: none;
        text-indent: 0.01px;
        text-overflow: ellipsis;
    }
</style>
<div style="width: 500px; height: 300px;">
	<div style="color: white;font-size: 25px;font-weight: bold; background: #E040FB; height: 90px;text-align: center; padding-top: 13px; border-radius: 5px; position: relative;">
		Phân quyền User
	
	<div style="text-align: center; font-weight: bold;font-size: 14px; color: white; position: absolute; left: 167px; top: 41px;" anlong = "<?=$username?>" id ="username">User hiện tại: <?=$username?></div>
	<div style="text-align: center; font-weight: bold;font-size: 14px; color: white; position: absolute; left: 167px; top: 60px;">Quyền hiện tại: <?=$quyen?></div>
	</div>
	<div style="text-align: center; height: 210px;">
	<div><label style="color: purple; font-weight: bold;">Chọn quyền muốn sửa</label></div>
	<select class="selectWrapper" id="quyen">
	<option anlong="2">Quản lý</option>
	<option anlong="3">Nhân viên</option>
	<option anlong="4">Khách hàng</option>
	</select>
	<div><input style="margin-top: 23px;" type="button" name="" class="xacnhan" value="Xác nhận"></div>
	</div>
</div>
<script type="text/javascript">
	$(document).ready(function()
	{
		$(".xacnhan").click(function()
			{
				var user = $("#username").attr("anlong");
				var quyen = document.getElementById("quyen").value;
				var idquyen = "";

				if(quyen == "Quản lý")
				{
					idquyen = "2";
				}
				if(quyen == "Nhân viên")
				{
					idquyen = "3";
				}
				if(quyen == "Khách hàng")
				{
					idquyen = "4";
				}
				$.post("xulysuaquyen.php", {user: user, idquyen: idquyen}, function(data)
                {
                    $("#modalcontent").html(data);
                    
                });  
			});
	});
</script>