<?php
	$conn = mysqli_connect("localhost", "root", "", "web");  

	if(isset($_POST['username'])){
		$output = "";
		$query = "select * from hoadon inner join chitiethoadon on hoadon.ma_hoadon = chitiethoadon.ma_hoadon WHERE hoadon.username ='".$_POST['username']."'";
		$result = mysqli_query($conn,$query);
		$output ='
		<div class="table-responsive">
 			<table class="table table-bordered table-striped">
  				<tr>  
					<th width="15%">IDHD</th>
					<th width="10%">Mã sản phẩm</th>
					<th width="5%">Số lượng</th>
					<th width="15%">Đơn giá</th>
					<th width="15%">Thành tiền</th>
					<th width="20%">Ngày lập</td>
					<th width="20%">Trạng thái</th>
				</tr>
		';
		while($row = mysqli_fetch_array($result)){
			$output .= 
			'
			<tr>
				<td>'.$row['ma_hoadon'].'</td>
				<td>'.$row['masp'].'</td>
				<td>'.$row['soluong'].'</td>
				<td>'.$row['dongia'].'</td>
				<td>'.$row['thanhtien'].'</td>
				<td>'.$row['ngaylap'].'</td>
				<td>'.$row['trangthai'].'</td>
			</tr>';
		}
		$output.= '</table></div>';
		echo $output;
	}
?>