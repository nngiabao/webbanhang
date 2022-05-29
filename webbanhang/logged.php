<?php
    session_start();
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title></title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">

<!-- jQuery library  https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<!-- Popper JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
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
	$('#checkprofile').click(function(){
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
  $('#changePass').click(function(){
    var username = $('#logout').val();
    var oldpass = $('#oldpass').val();
    var newpass = $('#newpass').val();
    var reoldpass = $('#reoldpass').val();
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
          $('#changeForm').reset();
        }else{
          alert("Mật khẩu không đúng");
        }
      }
    });
    }else{
      alert("Mật khẩu xác nhận không khớp");
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
});
</script>	
</head>
<body>
  		 <div class="login">
		    <?php 
			if(isset($_SESSION['username'])){
			?>
			<div class="dropdown">
			<button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				<?php echo $_SESSION['username'] ?>
			</button>
			 <button type="submit" class="btn btn-primary" value=""><a href="#"><i class="fa fa-shopping-cart"></i></a></button> 
			<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
					  <button type ="button" class="dropdown-item" id="checkprofile" >Thông tin tài khoản</button>
					  <button type ="button" class="dropdown-item" id="changeprofile" >Thay đổi thông tin tài khoản</button>
					  <button type="button" class="dropdown-item" id="checkhistory" data-target="#checkhistoryModal" data-toggle="modal">Lịch sử mua hàng</button>
					  <button type="button" class="dropdown-item" id="chagepass" data-target="#changepassModal" data-toggle="modal">Đổi mật khẩu</button>
					  <button type="button" class="dropdown-item" id="logout" value="<?php echo $_SESSION['username']?>" >Đăng xuất</button>
			</div>
			</div>
			<?php
				}else{
			?>

			<button type="button" class="btn btn-primary" value="" id="" data-toggle="modal" data-target="#loginModal">Đăng Nhập</button>
			<button type="button" class="btn btn-primary" value="" id="" data-toggle="modal" data-target="#signupModal">Đăng Ký</button>
			<button type="submit" class="btn btn-primary" value=""><a href="#"><i class="fa fa-shopping-cart"></i></a></button> 
		  <?php } ?>
          </div>
</body>
</html>
	<!--Modal xem profile -->
	<div class="modal fade" id="profileModal">
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
	<div class="modal fade" id="updateprofileModal">
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
							<input type="text" class="form-control" id="sdt" required="">
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
					<form id="changeForm">
                     <label>Nhập mật khẩu cũ</label>  
                     <input type="text" name="username" id="oldpass" class="form-control"/>  
                     </br>  
					<label>Nhập lại mật khẩu</label>  
                     <input type="text" name="username" id="reoldpass" class ="form-control"/>  
                     </br>  
                     <label>Nhập mật khẩu mới</label>  
                     <input type="text" name="password" id="newpass" class="form-control" />  
                     </br>  
			  		 <input type="submit" id="changePass" class="btn btn-success" value="Đổi mật khẩu">
			   		</form>
                </div>  
           </div>  
      </div>  
 </div>
<!--Modal check lịch sử-->

<!--Modal đăng nhập-->
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
<!--Modal đăng ký-->
<div class="modal fade" id="signupModal">
		<div class="modal-dialog modal-dialog-centered">
			<div class="modal-content d-flex justify-content-center h-100">
				<div class="modal-header d-flex justify-content-center">
					<h3 class="modal-title text-center text-primary" id="signuplbl w-100"> Sign up </h3>
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					</div>	
				<div class="modal-body d-flex justify-content-center">
					<form id="formdangky" method="POST">
						<div class="form-group">
							<label for="username">Tài khoản</label>
							<input type="text" class="form-control" id="username2" required="" placeholder="Nhập tài khoản...">
							<span id="thongbaousername"></span>
							</br>
							<label for="password">Mật khẩu</label>
							<input type="text" class="form-control" id="password2" required="" placeholder="Nhập mật khẩu...">
							</br>
							<label>Xác nhận mật khẩu</label>
							<input type="password" class="form-control" id="repassword" required="" placeholder="Nhập lại mật khẩu...">
							<span id="thongbaopassword"></span>
							</br>
							<label>Họ và tên</label>
							<input type="text" class="form-control" id="hoten" required="" placeholder="Nhập họ tên..">
							<label>Email</label>
							<input type="text" class="form-control" id="email" required="" pattern="[^@]+@[^@]+\.[a-zA-Z]{2,}" placeholder="Nhập email..">
							<span id="thongbaoemail"></span> 
							</br>			
							<label>Số điện thoại</label>
							<input type="text" class="form-control" id="phone" required="" pattern ="[0-9]{10}" placeholder="Nhập số điện thoại...">
							</br>
							<label>Ngày sinh</label>
							<input type="date" min ="2020-01-01" max="2020-12-31" class="form-control" id="dob">
							</br>
							<label for="sex">Giới tính</label>
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
