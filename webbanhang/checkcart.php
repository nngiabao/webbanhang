<?php
session_start();
	if(!empty($_SESSION['giohang'])){
		echo 1;
	}else{
		echo 0;
	}
?>