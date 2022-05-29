<?php
	session_start();
	if(isset($_POST['action'])){
		if($_POST['action'] == 'add'){
			if(isset($_SESSION['giohang'])){
				$checksl = 0;
				foreach ($_SESSION['giohang'] as $keys => $values){
					if($_SESSION['giohang'][$keys]['masp'] == $_POST['masp']){
					   $checksl++;
					   $_SESSION['giohang'][$keys]['soluong'] =  $_SESSION['giohang'][$keys]['soluong'] + $_POST['soluong'];
					}
				}
				
				if($checksl == 0){
					$sanpham = array(
						'masp' => $_POST['masp'],
						'tensp' => $_POST['tensp'],
						'giasp' => $_POST['giasp'],
						'soluong' => $_POST['soluong'],
						'hinhsp' => $_POST['hinhsp']
					);
					$_SESSION['giohang'][] = $sanpham;
				}
			}else{
				$sanpham = array(
						'masp' => $_POST['masp'],
						'tensp' => $_POST['tensp'],
						'giasp' => $_POST['giasp'],
						'soluong' => $_POST['soluong'],
						'hinhsp' => $_POST['hinhsp']
				);
				$_SESSION['giohang'][] = $sanpham;	
			}
		}
		if($_POST['action'] == 'remove'){
			foreach($_SESSION['giohang'] as $keys => $values){
  				if($values['masp'] == $_POST['masp']){
					unset($_SESSION['giohang'][$keys]);
				}
 			}
		}
		if($_POST['action'] == 'clear'){
			unset($_SESSION['giohang']);
		}
	}
?>	
