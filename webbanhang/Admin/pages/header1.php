<script src="https://code.jquery.com/jquery-latest.js"></script>

<link href="../assets/css/admin_style.css" rel="stylesheet" />
      <nav class="navbar navbar-expand-lg navbar-transparent navbar-absolute fixed-top ">
        <div class="container-fluid">
          <div class="navbar-wrapper">
          <a class="navbar-brand" href="#">Admin Page</a>
          </div>
          <button class="navbar-toggler" type="button" data-toggle="collapse" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation" >
            <span class="sr-only">Toggle navigation</span>
            <span class="navbar-toggler-icon icon-bar"></span>
            <span class="navbar-toggler-icon icon-bar"></span>
            <span class="navbar-toggler-icon icon-bar"></span>
          </button>
          <div class="collapse navbar-collapse justify-content-end" >
            
            <form class="navbar-form" action="">
              <div class="input-group no-border" >
                <input type="text" value="" name= "txtTimkiem" id="idtxtTimkiem" class="form-control" placeholder="Search...">
                <button type="button" id="timkiem" class="btn btn-white btn-round btn-just-icon timkiemBtn">
                  <i class="material-icons">search</i>
                </button>
              </div>
            </form>



            <ul class="navbar-nav" >
            <li class="nav-item dropdown">
                <a class="nav-link" href="javascript:;" id="navbarDropdownProfile" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="material-icons">person</i>
                  <p class="d-lg-none d-md-block">
                    Account
                  </p>
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownProfile">
                  <a class="dropdown-item" href="#">Tài khoản</a>
                  <a class="dropdown-item" href="#">Đổi mật khẩu</a>
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item" href="#">Đăng xuất</a>
                </div>
              </li>
            </ul>
          </div>
        </div>
      </nav>
      <script type="text/javascript">
            //ajax tìm kiếm
            $(document).ready(function()
            {
              $(".timkiemBtn").click(function(){
                var timkiem = document.getElementById("idtxtTimkiem").value;
                $.get("qlsanpham.php", {timkiem: timkiem}, function(data){
                    $("#noidung").html(data);
                    //gán lại ô tìm kiếm
                    document.getElementById("idtxtTimkiem").value = timkiem;
                });
              });
            });
      </script>