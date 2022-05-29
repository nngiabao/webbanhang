

<?php
require "ConnectDB.php";
$sqltongtien = "select * from hoadon";
$rstongtien = mysqli_query($con, $sqltongtien);
$tongtien = 0;
while ($rowtongtien = mysqli_fetch_array($rstongtien)) 
{
    $tongtien += $rowtongtien["tongtiensaukhigiam"];
}
$sqlsoluongban = "select * from sanpham";
$rssoluongban = mysqli_query($con, $sqlsoluongban);
$soluongban = 0;
while ($rowsoluongban = mysqli_fetch_array($rssoluongban)) 
{
  $soluongban += $rowsoluongban["soluongdaban"];
}
//-----------------------------------------------------
// $sosanpham1trang = 4;
// $sql2 = "SELECT * FROM  `sanpham` WHERE trangthai = '1'";//lay toan bo san phảm 
// $tong = mysqli_query($con, $sql2);
// $tong = $tong -> num_rows;//lấy tổng số sản phẩm
// $current_page = (!empty($_GET['trang'])) ? $_GET['trang'] : 1;
// //var_dump($tong);
// //------------------------------------------------------
// $tongTrang = ceil($tong / $sosanpham1trang);//tính tổng số trang
$sql1234 = "select * from menucon where trangthai = 1";
$res = mysqli_query($con, $sql1234);

include("header.php");
?>

<style type="text/css">
  .selectWrapper {
    width: 150px;
    overflow: hidden;
    position: relative;
    border: 1px solid #bbb;
    border-radius: 2px;
    background:#FFFFFF url('data:image/svg+xml,%3Csvg%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20width%3D%2211%22%20height%3D%2211%22%20viewBox%3D%220%200%2011%2011%22%3E%3Cpath%20d%3D%22M4.33%208.5L0%201L8.66%201z%22%20fill%3D%22%2300AEA9%22%2F%3E%3C%2Fsvg%3E') right 13px center no-repeat;
}

.selectWrapper select {
        padding: 12px 40px 12px 20px;
        font-size: 18px;
        line-height: 18px;
        width: 100%;
        border: none;
        box-shadow: none;
        background: transparent;
        background-image: none;
        -webkit-appearance: none;
        outline: none;
        cursor: pointer;
        -moz-appearance: none;
        text-indent: 0.01px;
        text-overflow: ellipsis;
    }
</style>
<div class="row">
            <div class="col-lg-3 col-md-6 col-sm-6">
              <div class="card card-stats">
                <div class="card-header card-header-success card-header-icon">
                  <div class="card-icon">
                    <i class="material-icons">store</i>
                  </div>
                  <p class="card-category">Tổng tiền đã bán</p>
                  <h3 class="card-title" style="font-size: 20px;"><?=number_format($tongtien,0,",",".") ?> Đ</h3>
                </div>
                <div class="card-footer">
                  <div class="stats">
                    <i class="material-icons">date_range</i> Toàn thời gian
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6">
              <div class="card card-stats">
                <div class="card-header card-header-danger card-header-icon">
                  <div class="card-icon">
                    <i class="material-icons">content_copy</i>
                  </div>
                  <p class="card-category">Số lượng đã bán</p>
                  <h3 class="card-title"><?=$soluongban?></h3>
                </div>
                <div class="card-footer">
                  <div class="stats">
                    <i class="material-icons">local_offer</i> Tổng toàn bộ sản phẩm
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6">
              <div class="card card-stats">
                <div class="card-header card-header-info card-header-icon">
                  <div class="card-icon">
                    <i class="material-icons">date_range</i>
                  </div>
                  <p class="card-category">Lượng truy cập</p>
                  <h3 class="card-title">+2301</h3>
                </div>
                <div class="card-footer">
                  <div class="stats">
                    <i class="material-icons">update</i> Toàn thời gian
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-lg-8 col-md-12">
              <div class="card">
                <div class="card-header card-header-warning">
                  <h4 class="card-title">Thống kê sản phẩm</h4>
                  <p class="card-category">Doanh thu các sản phẩm</p>
                    <div>
                      
                      <select style="float: left;" class="selectWrapper sort" id="idsort">
                        <option id="tang" value="masp">Mã sản phẩm</option>
                        <option id="giam" value="ngaydang">Ngày đăng bán</option>
                        <option id="giam" value="soluongdaban">Số lượng đã bán</option>
                        <option id="giam" value="tongthu">Tổng thu</option>
                      </select>
                      <select style="margin-left: 6px ;float: left; width: 100px;" class="selectWrapper sapxep" id="idsapxep">
                        <option id="tang" value="asc">Tăng dần</option>
                        <option id="giam" value="desc">Giảm dần</option>
                      </select>
                        <select class="selectWrapper loai" name="loai" id="loaisp" style="float: right; width: 190px;">
                        <?php
                        //loại
                            while ($row = mysqli_fetch_array($res))
                            { 
                            ?>
                        <option id="loaisp" value="<?=$row['id_con']?>"><?=$row['tenMenucon']?>
                        </option>
                        <?php }?>
                        </select>
                    </div>
                </div>
                <div class="card-body table-responsive">
                  <table class="table table-hover">

                      <div id="thongke"></div>
                  </table>

                </div>
              </div>
            </div>

               <div class="col-lg-4 col-md-12">
              <div class="card">
                <div class="card-header card-header-warning">
                  <h4 class="card-title">Sản phẩm bán chạy</h4>
                  <p class="card-category">Top 5 sản phẩm bán chạy toàn thời gian</p>
                </div>
                <div class="card-body table-responsive">
                  <table class="table table-hover">
                      <thead class="text-warning">
                      <th>Mã</th>
                      <th>Tên</th>
                      <th>Đã bán</th>
                      <th>Tổng thu</th>
                    </thead>
                    <tbody>
                      <div>
                      <?php
                        $sqltop = "Select * from sanpham where trangthai = 1 order by soluongdaban desc limit 5";
                        $rss = mysqli_query($con, $sqltop);
                        while ($row = mysqli_fetch_array($rss))
                            { 
                      ?>
                      <tr>
                        <td><?=$row["masp"]?></td>
                        <td><?=$row["tensp"]?></td>
                        <td><?=$row["soluongdaban"]?></td>
                        <td><?=$row["tongthu"]?></td>
                      </tr>
                    <?php }?>
                      </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
  <script type="text/javascript">
      $(document).ready(function()
      {
        var sapxep = "asc";
        var act = 1;
        var sort = "masp";
        $.post("thongkesanpham.php", {act: act, sapxep: sapxep, sort : sort}, function(data)
                {
                    $("#thongke").html(data);
                });
      });  


       $(document).ready(function()
      {
        $(".loai").change(function()
        {
            var sort = document.getElementById("idsort").value;
            var sapxep = document.getElementById("idsapxep").value;
            var act = document.getElementById("loaisp").value;
            $.post("thongkesanpham.php", {act: act, sapxep: sapxep, sort: sort}, function(data)
                {
                    $("#thongke").html(data);
                });
        });
      });  
      $(document).ready(function()
      {
        $(".sort").change(function()
        {
            var sapxep = document.getElementById("idsapxep").value;
            var act = document.getElementById("loaisp").value;
            var sort = document.getElementById("idsort").value;
            $.post("thongkesanpham.php", {act: act, sapxep: sapxep, sort:sort}, function(data)
                {
                    $("#thongke").html(data);
                });
        });
      });    

      $(document).ready(function()
      {
        $(".sapxep").change(function()
        {
            var sort = document.getElementById("idsort").value;
            var act = document.getElementById("loaisp").value;
            var sapxep = document.getElementById("idsapxep").value;
            $.post("thongkesanpham.php", {sapxep: sapxep, act: act, sort:sort}, function(data)
                {
                    $("#thongke").html(data);
                });
        });
      });                 
  </script>