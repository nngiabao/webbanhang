<?php
	session_start();
	
$tongtien = 0;

$tongsp = 0;

$output ='
		<div class="table-responsive" id="order_table">
 			<table class="table table-bordered table-striped">
  				<tr>  
					<th width="33%">Tên sản phẩm</th>
					<th width="10%">Hình</th>
					<th width="5%">Số lượng</th>
					<th width="22%">Đơn giá</th>
					<th width="22%">Thành tiền</th>
					<th width="3%"></th>
				</tr>
';

	if(!empty($_SESSION['giohang'])){
		foreach($_SESSION['giohang'] as $keys => $values){
			$output .=
			'<tr>
				<td>'.$values['tensp'].'</td>
				<td ><img src='.$values['hinhsp'].' style="width:80px;height:50px;"></td>
				<td align="center">'.$values['soluong'].'</td>
				<td>'.number_format($values['giasp'],0,",",".").' VND</td>
				<td>'.number_format($values['soluong']*$values['giasp'],0,",",".").' VND</td>
				<td><button class="btn btn-danger xoasp" id="'.$values['masp'].'">Xóa</button></td>
			</tr>';
		$tongtien = $tongtien + ($values['giasp'] * $values['soluong']);
		$tongsp = $tongsp +1;
		}
		$output .= 
			'<tr>
				<td colspan="4" align="right">Tổng tiền</td>
				<td colspan="2" align="left">'.number_format($tongtien,0,",",".").' VND</td>
			</tr>';
	}else{
	 $output .= '
		<tr>
			 <td colspan="6" align="center">Giỏ hàng trống!</td>
		</tr>
		';
	}
	$output .= '</table></div>';
	echo $output;
?>