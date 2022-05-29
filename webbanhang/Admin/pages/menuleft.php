<?php 
  session_start();
  require("ConnectDB.php");
  $username = $_SESSION['username'];
  $sqltest = "select * from user where username='$username'";
  $rstest = mysqli_query($con, $sqltest);
  $xacnhan = 0;
  while ($row = mysqli_fetch_array($rstest)) 
  {
    # code...
    if($row['quyen'] == 1)
    {
      $xacnhan = 1;
    }
    if($row['quyen'] == 2)
    {
      $xacnhan = 2;
    }
    if($row['quyen'] == 3)
    {
      $xacnhan = 3;
    }
  }
?>

<script src="https://code.jquery.com/jquery-latest.js"></script>
<?php if($xacnhan == 2)
{?>
<div class="sidebar" data-color="purple" data-background-color="white" >
      <div class="logo"><a href="./dashboard.php" class="simple-text logo-normal">
          ADMIN
        </a></div>
      <div class="sidebar-wrapper">
        <ul class="nav">
          <!-- lenh php hien hover mau tim cho li da chon-->
          <li class="nav-item " id="idtrangchu" anlong ="trangchu">
            <a class="nav-link" href="#" anlong ="trangchu" name="trangchu">
              <i class="material-icons " >dashboard</i>
              <p>Trang chủ</p>
            </a>
          </li>


          <li class="nav-item " id="idqluser" anlong ="qluser">
            <a class="nav-link" href="#" anlong ="qluser" name="user">
              <i class="material-icons" >person</i>
              <p>Quản lý User</p>
            </a>
          </li>


          <li class="nav-item " id="idqldonhang" anlong ="qldonhang">
            <a class="nav-link" href="#" anlong ="qldonhang" name="qldonhang">
              <i class="material-icons" >content_paste</i>
              <p>Quản lý đơn hàng</p>
            </a>
          </li>

          <li class="nav-item >" id="idqlsanpham" anlong ="qlsanpham">
            <a class="nav-link" id="qlsanpham" href="#" anlong ="qlsanpham" name="sanpham">
              <i class="material-icons">library_books</i>
              <p>Quản lý sản phẩm</p>
            </a>
          </li>


          <li class="nav-item " id="idkhuyenmai" anlong ="khuyenmai">
            <a class="nav-link" id="khuyenmai" href="#" anlong ="khuyenmai" name="khuyenmai">
              <i class="material-icons">bubble_chart</i>
              <p>Khuyến mãi</p>
            </a>
          </li>
        </ul>
      </div>
    </div>
  <?php }?>
  <?php if($xacnhan == 1)
{?>
  <div class="sidebar" data-color="purple" data-background-color="white" >
      <div class="logo"><a href="./dashboard.php" class="simple-text logo-normal">
          ADMIN
        </a></div>
      <div class="sidebar-wrapper">
        <ul class="nav">
          <li class="nav-item " id="idtrangchu" anlong ="trangchu">
            <a class="nav-link" href="#" anlong ="trangchu" name="trangchu">
              <i class="material-icons " >dashboard</i>
              <p>Trang chủ</p>
            </a>
          </li>
          <li class="nav-item " id="idqluser" anlong ="qluser">
            <a class="nav-link" href="#" anlong ="qluser" name="user">
              <i class="material-icons" >person</i>
              <p>Quản lý User</p>
            </a>
          </li>
          </ul>
      </div>
    </div>
  <?php }?>
  <?php if($xacnhan == 3)
{?>
  <div class="sidebar" data-color="purple" data-background-color="white" >
      <div class="logo"><a href="./dashboard.php" class="simple-text logo-normal">
          ADMIN
        </a></div>
      <div class="sidebar-wrapper">
        <ul class="nav">
          <li class="nav-item " id="idtrangchu" anlong ="trangchu">
            <a class="nav-link" href="#" anlong ="trangchu" name="trangchu">
              <i class="material-icons " >dashboard</i>
              <p>Trang chủ</p>
            </a>
          </li>
          <li class="nav-item " id="idqldonhang" anlong ="qldonhang">
            <a class="nav-link" href="#" anlong ="qldonhang" name="qldonhang">
              <i class="material-icons" >content_paste</i>
              <p>Quản lý đơn hàng</p>
            </a>
          </li>
          </ul>
      </div>
    </div>
  <?php }?>
    <script>
      $(document).ready(function(){
        var act = "trangchu";
        if(act == "trangchu")
            {
              $("#idtrangchu").attr("class","nav-item active");
            } else $("#idtrangchu").attr("class","nav-item");
            $.post("ajaxmenu.php", {act: act}, function(data){
              $("#noidung").html(data);
            });
        });

      $(document).ready(function(){
        $(".nav-item").click(function(){
            var act = $(this).attr("anlong");
            //tạo hover
            if(act == "trangchu")
            {
              $("#idtrangchu").attr("class","nav-item active");
            } else $("#idtrangchu").attr("class","nav-item");
            if(act == "qluser")
            {
              $("#idqluser").attr("class","nav-item active");
            } else $("#idqluser").attr("class","nav-item");
            if(act == "qldonhang")
            {
              $("#idqldonhang").attr("class","nav-item active");
            } else $("#idqldonhang").attr("class","nav-item");
            if(act == "qlsanpham")
            {
              $("#idqlsanpham").attr("class","nav-item active");
            } else $("#idqlsanpham").attr("class","nav-item");
            if(act == "khuyenmai")
            {
              $("#idkhuyenmai").attr("class","nav-item active");
            } else $("#idkhuyenmai").attr("class","nav-item");
            //$(this).attr("class","nav-item active");
            $.post("ajaxmenu.php", {act: act}, function(data){
              $("#noidung").html(data);
            });
        });
      });
    </script>