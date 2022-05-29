<?php
	session_status();
	$tongtien = 0;
	$tongsp = 0;
	
	$output .='	
	<div class="table-responsive" id="oder_table">
		<div class="table table-bordered table-stripped>
			<tr>
				<th width="30%">Tên sản phẩm</th>
				<th width="20%">Ảnh sản phẩm</th>
				<th width>Số lượng</th>
				<th width="">Giá</th>
				<th width="">Thành tiền</th>
				<th width="5%"></th>
			</tr>';
	if(!empty($_SESSION['giohang'])){
		foreach($_SESSION['giohang'] as $spgiohang => $value){
			$output.='
				<tr>
					<td>'.$value['tensp'].'</td>
					<td>'.$value['anhspsp'].'</td>
					<td>'.$value['soluong'].'</td>
					<td>'.$value['giaspsp'].'</td>
					<td>'.$value['soluong']*$value['giasp'].'</td>
					<td><button class="btn btn-danger btn-delete-xs">Xóa</button></td>
				</tr>
			';
			$tongtien += $value['giasp']*$value['soluong'];
			$tongsp += 1;	
		}
		$output .= '
			<tr>
				<td colspan="3" align>Tổng tiền</td>
				<td align="center">'.$tongtien.'</td>
				<td></td>
			</tr>'
	}else{
		$output .='
		<tr>
			<td colspan="5">Chưa có sản phẩm nào được chọn</td>
		</tr>'
	}
	$output .='</table></div>';
	
	$data = array(
		'cart_details' => $output,
		'total_price' => $tongtien,
		'total_item' => $tongsp;
	)
	   
	echo json_encode($data);   
	   
	if(isset($_POST['action'])){
		if($_POST['action'] == 'xoa'){
			foreach($_SESSION['shopping_cart'] as $keys => $values){
				if($values['masp'] == $_POST['masp']){
					unset($_SESSION['shopping_cart'][$keys])
				}
			}
		}
	}
	/*--Clear giỏ hàng--*/
	if(isset($_POST['action'] == 'clear')){
            unset($_SESSION['giohang']);
	}   
?>