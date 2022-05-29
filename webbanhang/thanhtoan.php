<?php

session_start();

$tongtien = 0;

$chitietsp = '';

$output = '
<div class="table-responsive" id="order_table">
	<table class="table table-bordered table-striped">
		<tr>  
			<th width="30%">Tên sản phẩm</th>
			<th width="10%">Hình</th>
			<th width="15%">Số lượng</th>
			<th width="20%">Đơn giá</th>
			<th width="20%">Thành tiền</th>
			</tr>
';

if(!empty($_SESSION["giohang"])){
	foreach($_SESSION["giohang"] as $keys => $values){
  $output .= '
  <tr>
   <td>'.$values["tensp"].'</td>
   <td ><img src='.$values['hinhsp'].' style="width:80px;height:50px;"></td>
   <td>'.$values["soluong"].'</td>
   <td align="right">'.$values["giasp"].' VND</td>
   <td align="right">'.number_format($values["soluong"] * $values["giasp"],0,",",".").' VND</td>
  </tr>
  ';
  $tongtien = $tongtien + ($values["soluong"] * $values["giasp"]);

  $chitietsp .= $values["tensp"] . ', ';
 }
 $chitietsp = substr($chitietsp, 0, -2);
 $output .= '
 <tr>  
        <td colspan="4" align="right">Tổng tiền</td>  
        <td align="right">'.number_format($tongtien,0,",",".").' VND</td>
    </tr>
 ';
}
$output .= '</table>';

?>

<!DOCTYPE html>
<html>
 <head>
  <title>Thanh toán</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
	 <script>
	 	$(document).ready(function(){
			$('#magg').blur(function(){
				var magg = $('#magg').val();
				var tongtien1 = parseInt($('#tongtien1').val(),10);
				var tongtien2 = $('#tongtien2').val();
				if(magg != ''){
					$.ajax({
						url: "xulytrung.php",
						method: "POST",
						data: {magg : magg},
						success: function(data){
							if(data == 0){
								alert("mã giảm giá không có");
							}else{
								var tien = tongtien1-parseInt(data,10);
								$('#tongtien2').val(tien.toString());
							}
						}
					});
				}
			});
			function taoID(){
				var mahd = "";
  				var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
			    for (var i = 0; i < 6; i++){
					mahd += possible.charAt(Math.floor(Math.random() * possible.length));
				}
				return mahd;
			}

			function checkTrung(mahd){
				var mahd = mahd;
				$.ajax({
					url: "xulytrung.php",
					method: "POST",
					data: {mahd : mahd},
					success: function(data){
						if(data == 1){
							return 1;
						}else return 0;
					}
				});
			}

			$('#paybtn').click(function(){
				var mahd = taoID();
				var diachi = $('#diachi').val();
				var ghichu = $('#ghichu').val();
				var magg = $('#magg').val();
				var username = $('#username').val();
				var tongtien1 = $('#tongtien1').val();
				if(magg == ''){
					$('#tongtien2').val(tongtien1);
					magg = "Null";
				}else{

				}

				var tongtien2 = $('#tongtien2').val();
				if(diachi == ''){
					alert('Địa chỉ không được để trống');
				}else{
					$.ajax({
						url: "xulythanhtoan.php",
						method: "POST",
						data: {
							mahd : mahd,
							username : username,
							magg : magg,
							ghichu : ghichu,
							diachi : diachi,
							tongtien1 : tongtien1,
							tongtien2 : tongtien2
						},
						success: function(data){
							//window.location.replace('http://localhost/dangdung/ProjectPHPv3/');
							alert(data);
						} 
					});
				}
			});			   
		});
	 </script>
 </head>
 <body>
  <div class="container">
   <div class="panel panel-default">
    <div class="panel-heading">Thanh toán đơn hàng</div>
    <div class="panel-body">
     <form method="post" id="thanhtoanform" action="xulythanhtoan.php">
      <div class="row">
       <div class="col-md-4" style="border-right:1px solid #ddd;">
        <h4 align="center">Thông tin hóa đơn</h4>
        <div class="form-group">
         <label><b>Mã giảm giá</b></label>
               <input type="text" id="magg" class="form-control" value="" />
               <span id="thongbaoma" class="text-danger"></span>
           </div>
          <div class="form-group">
            <label><b>Địa chỉ nhận hàng<span class="text-danger">*</span></b></label>
            <textarea name="address" id="diachi" class="form-control" required=""></textarea>
           </div>
           <div class="form-group">
            <label><b>Ghi chú</b></label>
            <textarea id="ghichu" class="form-control" required=""></textarea>
           </div>
           <hr />
              <br />
        <div align="center">
         <input type="hidden" id="tongtien1" value="<?php echo $tongtien; ?>" />
		 <input type="hidden" id="tongtien2" value="" />
         <input type="hidden" id="chitietsp" value="<?php echo $chitietsp; ?>" />
		<input type="hidden" id="username" value="<?php echo $_SESSION['username'] ?>" />	
         <input type="button" id="paybtn" class="btn btn-success btn-sm" value="Đặt hàng ngay"/>
        </div>
        <br />
       </div>
       <div class="col-md-8">
        <h4 align="center">Thông tin giỏ hàng</h4>
        <?php
        echo $output;
        ?>
       </div>
      </div>
     </form>
    </div>
   </div>
  </div>
 </body>
</html>