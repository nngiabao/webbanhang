<?php
	session_start();
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <meta charset="utf-8">
  <title></title>
  <!--<link rel="stylesheet" href="bootstrap4/css/bootstrap.min.css">
  <link rel="stylesheet" href="bootstrap4/js/bootstrap.min.js">
  <link rel="stylesheet" href="js/jquery.min.js">-->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
	<!-- -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
  <!-- <link rel="stylesheet" href="../css/style.css"> -->
  <style>
  .popover
  {
      width: 100%;
      max-width: 800px;
	  height: 800px;
  }
    .popover.fade.bottom.in
  {
    top:99px;
    left: 657px;
    /*display: block;*/
    max-width: 800px;
  } 
  .arrow
  {
    left: 77%;
  }
  </style>
  
  <script>
$(document).ready(function(){
	loadcart();
	/*--Xử lí trùng username --*/
	$('#username2').blur(function(){
		var username = $('#username2').val();
		$.ajax({
			url: "xulytrung.php",
			method: "POST",
			data:{'username':username},
			success: function(data){
				if(data == 'username can use'){
					$('#thongbaousername').html('<span class="text-success">Tài khoản có thể sử dụng</span>');		
					kiemtra = 1;
				}else{
					$('#thongbaousername').html('<span class="text-danger">Tài khoản đã đăng ký</span>');	
					 kiemtra = 0;
				}
			} 
		});
	});	
	/*--Xử lí trùng email--*/
	$('#email').blur(function(){
		var email = $('#email').val();
		$.ajax({
			url: "xulytrung.php",
			method: "POST",
			data: {email : email},
			success: function(data){
				if(data == 'email can use'){
					$('#thongbaoemail').html('<span class="text-success">Email có thể sử dụng</span>');
					kiemtra = 1;
				}else{
					$('#thongbaoemail').html('<span class="text-danger">Email đã đăng ký</span>');
					kiemtra = 0;
				} 
			}
		});
	});
	/*-- Xử lí nút đăng ký--*/
	$('#formdangky').on('submit',function(event){
		event.preventDefault();
		var username = $('#username2').val();
		var password = $('#password2').val();
		var repassword = $('#repassword').val();
		var name = $('#hoten').val();
		var email = $('#email').val();
		var phone = $('#phone').val();
		var dob = $('#dob').val();
		var sex = $('#sex').val();
		
		if(username == ''){
			alert('Tài khoản không được để trống');
		}else if(password == ''){
			alert('Mật khẩu không được để trống');
		}else if(repassword == ''){
			alert('Mật khẩu nhập lại không được để trống');
		}else if(name == ''){
			alert('Họ tên không được để trống');	
		}else if(email == ''){
			alert('Email không được để trống');
		}else if(phone == ''){
			alert('Số điện thoại không được để trống');
		}else if(dob == ''){
			alert('Ngày sinh không được để trống');
		}else if (password != repassword){
			alert('Password nhập lại không khớp');
		}else if(kiemtra == 1){
			$.ajax({
				url: "xulydangky.php",
				method: "POST",
				data: {
					username : username,
					password : password,
					name : name,
					email : email,
					phone :phone,
					dob : dob,
					sex : sex,
				},
				success: function(data){
					alert('Đăng ký thành công. Mời đăng nhập để mua hàng');
					location.reload();
				}
			});
		}else{
			alert('kiểm tra lại form đăng ký');
		}
	});
	/*xử lí logged*/
  $('#checkprofile').click(function(){
    var username = $('#logout').val();
    $.ajax({
      url: "checkprofile.php",
      method: "POST",
      data: {username: username},
      success: function(data){
        $('#profileDetail').html(data);
        $('#profileModal').modal("show");
      }
    });
  });
  /* check history*/
	$('#checkhistory').click(function(){
    var username = $('#logout').val();
    $.ajax({
      url: "checkhistory.php",
      method: "POST",
      data: {username: username},
      success: function(data){
        $('#historyDetail').html(data);
        $('#historyModal').modal("show");
      }
    });
  });
  /* Đổi pass*/
  $('#changepass').click(function(){
    var username = $('#logout').val();
    var oldpass = $('#oldpass').val();
    var newpass = $('#newpass').val();
    var reoldpass = $('#reoldpass').val();
    if(oldpass == '' || reoldpass == ''){
		alert("Mật khẩu cũ hoặc xác nhận mật khẩu cũ không được để trống");
	}else{
	  if(oldpass == reoldpass){
		  $.ajax({
		  url: "xulydoipass.php",
		  method: "POST",
		  data: {username:username,
			  oldpass : oldpass,
			  newpass : newpass},
		  success: function(data){
			if(data == 'Success'){
			  alert("Đổi mật khẩu thành công");
			  $('#changepassModal').hide();
			}else{
			  alert("Mật khẩu không đúng");
					}
		  		}
			}); 
		}else{
		  alert("Mật khẩu xác nhận không khớp");
		}
	}
  });
  /*logout*/
  $('#logout').click(function(){
    var username = $('#logout').val();
    var action = "logout";
    $.ajax({
      url: "xulydangnhap.php",
      method: "POST",
      data: {action: action,username:username},
      success: function(){
        location.reload();
      }
    });
  });
  /* */
  $('#changeprofile').click(function(){
    var username = $('#logout').val();
    $.ajax({
      url: "updateprofile.php",
      method: "POST",
      data: {username:username},
      dataType: "json",
      success: function(data){
        $('#hoten').val(data.hoten);
        $('#ngaysinh').val(data.ngaysinh);
        $('#sdt').val(data.sodienthoai);
        $('#gioitinh').val(data.gioitinh);
        $('#updateprofileModal').modal('show'); 
      }
    });
  });
    
  $('#updateProfile').click(function(){
    var username = $('#logout').val();
    var action = "update"; 
    var name = $('#hoten').val();
    var sdt = $('#sdt').val();
    var dob = $('#ngaysinh').val();
    var sex = $('#gioitinh').val();
    if(name == ''){
      alert('Họ tên không được để trống');
    }else if(sdt == ''){
      alert('Số điện thoại không được để trống');
    }else if(dob == ''){
      alert('Ngày sinh không được để trống');
    }else{
      $.ajax({
      url: "updateprofile.php",
      method: "POST",
      data: {
        action : action,
        username: username,
        name : name,
        dob : dob,
        sex : sex,
        phone : sdt
      },
      success: function(data){
        $('#profileDetail').html(data);
        alert("Thay đổi thành công");
        }
      });
    }
  });
	
	/**/
  $('#loginbtn').click(function(){  
          var username = $('#username3').val();  
          var password = $('#password3').val();  
          if(username != '' && password != '')  
          {  
              $.ajax({  
                    url:"xulydangnhap.php",  
                    method:"POST",  
                    data: {username:username, password:password},  
                    success:function(data){   
						if(data == 0) {  
							alert('Tài khoản hoặc mật khẩu không đúng'); 
						}else if(data == 1){
							alert("hello");
							window.location.replace("http://localhost/dangdung/ProjectPHPv3/Admin/pages/dashboard.php")
						}else{
					  		$('#loginModal').hide();  
							location.reload();
						} 
					} 
              });  
          }else {  
              alert("Tài khoản hoặc mật khẩu không được để trống");  
          }  
    });  
	
	/*--load giỏ hàng--*/
	function loadcart(){
		$.ajax({
			url: "loadCart.php",
			method: "POST",
			success: function(data){
				$('#cartDetail').html(data);
			}	
		});
	}
	/*add cart*/
	$(document).on('click', '.buy-button', function(){
 		var masp = $(this).attr('id');
  		var tensp = $('#tensp'+masp+'').val();
  		var giasp = $('#giasp'+masp+'').val();
		var hinhsp = $('#hinhsp'+masp+'').val();
  		var soluong = 1;
  		var action = 'add';
	    $.ajax({
			url:"xulygiohang.php",
			method:"POST",
			data:{masp : masp, 
				  tensp : tensp, 
				  giasp : giasp, 
				  soluong : soluong, 
				  hinhsp : hinhsp,
				  action:action},
			success:function(data){
				loadcart();
				alert("Đã thêm vào giỏ hàng");
			}
	   });
 	});
/*--Xóa sp khỏi giỏ hàng--*/
	$(document).on('click','#xoasp',function(){
		var masp = $(this).attr('masp');
		var action = 'xoa';
		$.ajax({
			url: "xulygiohang.php",
			method: "POST",
			data: {masp: masp,action: action},
			success: function(data){
				loadcart();
				//location.reload();
				$('cartModal').hide();
				alert('Đã xóa khỏi giỏ hàng')
			}
		});
	});	
	/*--clear giỏ hàng--*/
	$(document).on('click','#clear',function(){
		var action = 'clear';
		$.ajax({
			url: "xulygiohang.php",
			method: "POST",
			data: {action: action},
			success: function(data){
				loadcart();
				$('#giohangpopover').modal('hide');
				alert('Bạn đã xóa tất cả sản phẩm');
			}
		});
	});
	/*--Xóa sp khỏi giỏ hàng--*/
	$(document).on('click','.xoasp',function(){
		var masp = $(this).attr('id');
		var action = 'remove';
		$.ajax({
			url: "xulygiohang.php",
			method: "POST",
			data: {masp: masp,action: action},
			success: function(data){
				loadcart();
				$('#giohangpopover').hide();
				alert('Đã xóa khỏi giỏ hàng')
			}
		});
	});	
	/*--clear giỏ hàng--*/
	$(document).on('click','#clearbtn',function(){
		var action = 'clear';
		$.ajax({
			url: "xulygiohang.php",
			method: "POST",
			data: {action: action},
			success: function(data){
				loadcart();
				$('#giohangpopover').popover('hide');
				alert('Bạn đã xóa tất cả sản phẩm');
			}
		});
	});
	/* check giỏ hàng*/
	function checkCart(){
		var result;
		$.ajax({
			url:"checkcart.php",
			method: "POST",
			success: function(data){
				if(data == 1){
					return 1;
				}else{
					return 0;
				}
			}
		});
	};
	/*-- Nút thanh toán */
	$(document).on('click','#checkoutbtn',function(){
		var username = $('#logout').val();
		$.ajax({
			url:"checkcart.php",
			method: "POST",
			success: function(data){
				if(data == 0){
					alert("Không có món nào trong giỏ hàng");
				}else{
					if (username == null){
						alert("Vui lòng đăng nhập để thanh toán");
					}else{
						window.location.replace("http://localhost/dangdung/ProjectPHPv3/thanhtoan.php");
					}
				}
			}
		});
	});
	
});
</script>	
</head>
<body>
  <?php
  $host = "localhost";
              $username = "root";
              $password = "";
              $dbname = "web";

              $conn = mysqli_connect($host, $username, $password, $dbname);
              mysqli_query($conn, "set names utf8");
              if($conn == false){
                  die("Kết nối thất bại");
              }
               
              // Print host information
              //echo "Kết nối thành công";
               
              // Close connection
              //mysqli_close($conn); 
   ?>
    <header>
    <div class="header-center">
      <div class="container">
        <div class="row">
          <div class="col-xs-12 col-sm-12 col-md-3">
            <div class="logo">
              <a href="#"><img src="img/logo.jpg" alt="logo"></a>
            </div>
          </div>

          <div class="col-xs-12 col-sm-12 col-md-4">
            <div class="search">
              <form action="#" method="POST" accept-charset="utf-8">
                <input type="text" class="form-control" name="txtTimKiem" id="idtxtTimKiem" placeholder="Bạn muốn tìm gì ?">

                <button type="button" id="timkiem" class="btn btn-primary timkiemBtn"><i class="fa fa-search"></i></button>
              </form>
            </div>
          </div>
          
          <div class="col-xs-12 col-sm-12 col-md-2">
            <div class="hotline">
              <div class="hotline_icon">
              <i class="fa fa-phone"></i></div>
              <div class="hotline_nd">
                <p>Hotline: </p>
                <b class="hot-line">19001010</b>
              </div>
            </div>
          </div>
          
          <div class="col-xs-12 col-sm-12 col-md-3">
            <div class="login">
              <?php 
                  if(isset($_SESSION['username'])){
                  ?>
                  <div class="dropdown">
                  <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <?php echo $_SESSION['username'] ?>
                  </button>
                     <button type="button" id="giohangbtn" class="btn btn-primary" 
							 value="" data-toggle="modal" data-target="#cartModal"><a href="#"><i class="fa fa-shopping-cart"></i></a></button>
                  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <button type ="button" class="dropdown-item" id="checkprofile" >Thông tin tài khoản</button>
                        <button type ="button" class="dropdown-item" id="changeprofile" >Thay đổi thông tin tài khoản</button>
                        <button type="button" class="dropdown-item" id="checkhistory">Lịch sử mua hàng</button>
                        <button type="button" class="dropdown-item" id="changePass" data-target="#changepassModal" data-toggle="modal">Đổi mật khẩu</button>
                        <button type="button" class="dropdown-item" id="logout" value="<?php echo $_SESSION['username']?>" >Đăng xuất</button>
                  </div>
                  </div>
                  <?php
                    }else{
                  ?>

              <button type="button" class="btn btn-primary" value="" data-toggle="modal" data-target="#loginModal"><a href="#">Đăng Nhập</a></button>
<div id="loginModal" class="modal fade" role="dialog">  
  <div class="modal-dialog">  
      <div class="modal-content">  
            <div class="modal-header">  
                <button type="button" class="close" data-dismiss="modal">&times;</button>  
                <h4 class="modal-title">Login</h4>  
            </div>  
            <div class="modal-body" style="position: relative; padding:15px; margin-bottom:69px;">  
                <label style="max-width: 100%; margin-bottom:50px;margin-top:8px; font-weight:700; float:left; clear: both;">Username: </label>  
                <input type="text" name="username" id="username3" class="form-control"/>  
                </br>  
                <label style="max-width: 100%; margin-bottom:50px;margin-top:8px ;font-weight:700; float:left; clear: both;">Password: </label>  
                <input type="password" name="password" id="password3" class="form-control" />  
                </br>  
            </div>  
    <div class="modal-footer">
    <button type="button" id="loginbtn" class="btn btn-warning">Login</button>  
    </div>
      </div>  
  </div>  
</div>

              <button type="submit" class="btn btn-primary" value="" data-toggle="modal" data-target="#signupModal"><a href="#">Đăng Ký</a></button>
<div class="modal fade" id="signupModal">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content d-flex justify-content-center h-100">
      <div class="modal-header d-flex justify-content-center">
        <h3 class="modal-title text-center text-primary" id="signuplbl w-100"> Sign up </h3>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>	
      <div class="modal-body d-flex justify-content-center" style="line-height: 50px;">
        <form id="formdangky" method="POST">
          <div class="form-group">
            <label style="max-width: 100%;font-weight:700; float:left; clear: both;" for="username">Tài khoản</label>
            <input style="margin-top:9px;margin-left:77px;" type="text" class="form-control" id="username2" required="" placeholder="Nhập tài khoản...">
            <span id="thongbaousername" style="float: left;"></span>
            </br>
            <label style="max-width: 100% ;font-weight:700; float:left; clear: both;" for="password">Mật khẩu</label>
            <input style="margin-top:9px;margin-left:81px;" type="password" class="form-control" id="password2" required="" placeholder="Nhập mật khẩu..." pattern="{6,}">
            </br>
            <label style="max-width: 100%;font-weight:700; float:left; clear: both;">Xác nhận mật khẩu</label>
            <input style="margin-top:9px;margin-left:15px;" type="password" class="form-control" id="repassword" required="" placeholder="Nhập lại mật khẩu..." pattern="{6,}">
            <span id="thongbaopassword"></span>
            </br>
            <label style="max-width: 100%;font-weight:700; float:left; clear: both;">Họ và tên</label>
            <input style="margin-top:9px;margin-left:78px;" type="text" class="form-control" id="hoten" required="" placeholder="Nhập họ tên.." >
            <label style="max-width: 100%;font-weight:700; float:left; clear: both;">Email</label>
            <input style="margin-top:9px;margin-left:104px;" type="text" class="form-control" id="email" required="" pattern="[^@]+@[^@]+\.[a-zA-Z]{2,}" placeholder="Nhập email..">
            <span id="thongbaoemail" style="float: left;"></span> 
            </br>			
            <label style="max-width: 100%;font-weight:700; float:left; clear: both;">Số điện thoại</label>
            <input style="margin-top:9px;margin-left:53px;" type="text" class="form-control" id="phone" required="" pattern ="[0-9]{10}" placeholder="Nhập số điện thoại...">
            </br>
            <label style="max-width: 100%;font-weight:700; float:left; clear: both;">Ngày sinh</label>
            <input style="margin-top:9px;margin-left:74px;" type="date" min ="2020-01-01" max="2020-12-31" class="form-control" id="dob">
            </br>
            <label style="max-width: 100%;font-weight:700; float:left; clear: both;" for="sex">Giới tính</label>
            <select class="form-control" id="sex">
              <option value="Nữ">Nữ</option>
              <option value="Nam">Nam</option>
            </select>
          </div>	
          <div class="d-flex justify-content-center mt-3 login_container">
            <input type="submit" name="submit" class="btn btn-danger justify-content-centered"  value="Đăng ký">
            </div>
        </form>	
      </div>
    </div>	
  </div>
</div>


              <button type="button" id="" class="btn btn-primary" value="" data-toggle="modal" data-target="#cartModal"><a href="#"><i class="fa fa-shopping-cart"></i></a></button>

               <?php } ?>
               
                           
            </div>
          </div>
        </div>
      </div>
    </div>

    <!--Menu-->
    <div class="main-menu">
      <div class="container">
        <ul class="menu">
          <li class="active">
            <a href="#"><i class="fa fa-bars"></i> Danh Mục Sản Phẩm</a>
            <ul class="sub-menu">
              <?php
              $listDoChoi = "SELECT * FROM menucha inner join menucon on menucon.id_cha = menucha.id_cha  where menucon.trangthai='1'";
              $result = mysqli_query($conn,$listDoChoi) or die("Lỗi truy cập danh sách danh mục");
              while($row = mysqli_fetch_array($result))
                  { 
               ?>

              <li><a class="nhan" id="idnhan" anlong ="<?=$row['id_con']?>" href="#"><?php echo $row['tenMenucon'] ?></a></li>
              <?php } ?>
            </ul>
          </li>
          <li><a href="#">Trang Chủ</a></li>
          <li><a href="#">Sản Phẩm Hot</a></li>
          <li><a href="#">Liên Hệ</a></li>
          <li><a href="#">Lịch Sử Đơn Hàng</a></li>
        </ul>
      </div>
    </div>
  </header><!-- /header -->


<br>
</body>
</html>
<!-- Cart Modal -->
<div class="modal fade" id="cartModal">
		<div class="modal-dialog modal-dialog-centered">
			<div class="modal-content d-flex justify-content-center h-100">
				<div class="modal-header d-flex justify-content-center">
					<h3 class="modal-title text-center text-primary" id="signuplbl">Thông tin giỏ hàng</h3>
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					</div>	
				<div class="modal-body" id="cartDetail"></div>	
				<div class="modal-footer d-flex justify-content-end">
					<div align="right">
					<a class="btn btn-primary" id="checkoutbtn">
					  <span class="glyphicon glyphicon-shopping-cart"></span> Thanh toán
					</a>
					<a href="#" class="btn btn-default" id="clearbtn">
					  <span class="glyphicon glyphicon-trash"></span> Xóa giỏ hàng
					</a>
					</div>
				</div>
			</div>	
		</div>
	</div>	
<!--Modal xem profile -->
	<div class="modal" id="profileModal">
		<div class="modal-dialog modal-dialog-centered">
			<div class="modal-content d-flex justify-content-center h-100">
				<div class="modal-header d-flex justify-content-center">
					<h3 class="modal-title text-center text-primary" id="signuplbl">Thông tin tài khoản</h3>
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					</div>	
				<div class="modal-body d-flex justify-content-center" id="profileDetail">
				</div>	
				<div class="modal-footer d-flex justify-content-end">
					<button class="btn btn-success justify-content-centered" data-dismiss="modal">Đóng</button>
				</div>
			</div>	
		</div>
	</div>	
	<!--Modal cập nhật thông tin-->
	<div class="modal" id="updateprofileModal">
		<div class="modal-dialog modal-dialog-centered">
			<div class="modal-content d-flex justify-content-center h-100">
				<div class="modal-header d-flex justify-content-center">
					<h3 class="modal-title text-center text-primary" id="signuplbl w-100">Cập nhật thông tin</h3>
					<button type="button" class="close" data-dismiss="modal">&times;</button>
				</div>	
				<div class="modal-body d-flex justify-content-center">
					<form method="post">
						<div class="form-group">
							<label for="name">Họ tên</label>
							<input type="text" class="form-control" id="hoten" required="">
							</br>
							<label for="dob">Ngày sinh</label>
							<input type="date" class="form-control" id="ngaysinh" required="">
							</br>	
							<label>Số điện thoại</label>
							<input type="text" class="form-control" id="sdt" required="" pattern ="[0-9]{10}">
							</br>
							<label>Giới tính</label>
							<select class="form-control" id="gioitinh">
								<option value="Nữ">Nữ</option>
								<option value="Nam">Nam</option>
							</select>
							</br>
							<input type="submit" id="updateProfile" class="btn btn-success" value="Cập nhật thông tin">
						</div>	
					</form>	
				</div>
				<div class="modal-footer">
					<button class="btn btn-success justify-content-centered" data-dismiss="modal">Đóng</button>
				</div>
		</div>	
		</div>	
	</div>
	<!--Modal đổi pass-->
	<div id="changepassModal" class="modal fade" role="dialog">  
      <div class="modal-dialog">  
           <div class="modal-content">  
                <div class="modal-header">  
					<h4 class="modal-title">Đổi password</h4>  
					<button type="button" class="close" data-dismiss="modal">&times;</button>  
                </div>  
                <div class="modal-body">  

                     <label>Nhập mật khẩu cũ</label>  
                     <input type="text" id="oldpass" pattern="" class="form-control"/>  
                     </br>  
					<label>Nhập lại mật khẩu</label>  
                     <input type="text" id="reoldpass" pattern="" class ="form-control"/>  
                     </br>  
                     <label>Nhập mật khẩu mới</label>  
                     <input type="text" id="newpass" class="form-control" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"/>  
                     </br>  
			  		 <button id="changepass" class="btn btn-success" value="">Đôi mật khẩu</button>
                </div>  
           </div>  
      </div>  
 </div>
<!--Modal check lịch sử-->
<div class="modal" id="historyModal">
		<div class="modal-dialog modal-dialog-centered">
			<div class="modal-content d-flex justify-content-center h-100">
				<div class="modal-header d-flex justify-content-center">
					<h3 class="modal-title text-center text-primary" id="signuplbl">Lịch sử đặt hàng</h3>
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					</div>	
				<div class="modal-body d-flex justify-content-center" id="historyDetail">
				</div>	
				<div class="modal-footer d-flex justify-content-end">
					<button class="btn btn-success justify-content-centered" data-dismiss="modal">Đóng</button>
				</div>
			</div>	
		</div>
	</div>	
	<script type="text/javascript">
		$(document).ready(function(){
        $(".nhan").click(function(){
            var masp = $(this).attr("anlong");
            $.post("content.php", {idcon: masp}, function(data){
              $("#noidung").html(data);
            });
            //alert(act);
        });
      });
		
		$(document).ready(function()
		{
			$.post("content.php", {idcon: 1}, function(data){
              $("#noidung").html(data);
            });
		});
		$(document).ready(function()
            {
              $(".timkiemBtn").click(function(){
                var timkiem = document.getElementById("idtxtTimKiem").value;
                var idcon = $("#layidcon").attr("anlong");
                $.post("content.php", {timkiem: timkiem, idcon: idcon}, function(data){
                    $("#noidung").html(data);
                });
              });
            });
	</script>