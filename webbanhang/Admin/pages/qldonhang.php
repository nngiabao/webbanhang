<?php
require "ConnectDB.php";

$sosanpham1trang = 10;

$trang = (!empty($_GET['trang'])) ? $_GET['trang'] : 1;
settype($trang, "int");

$from = ($trang - 1) * $sosanpham1trang;

$sql = "SELECT * FROM hoadon";
//------------------------------------------------------
$sql2 = "SELECT * FROM  hoadon";//lay toan bo san phảm 
$tong = mysqli_query($con, $sql2);
$tong = $tong -> num_rows;//lấy tổng số sản phẩm
$current_page = (!empty($_GET['trang'])) ? $_GET['trang'] : 1;
//var_dump($tong);
//------------------------------------------------------
$tongTrang = ceil($tong / $sosanpham1trang);//tính tổng số trang
//var_dump($tongTrang);
$rs = mysqli_query($con, $sql);
include ("header.php");
?>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-header card-header-primary">
                  <h4 class="card-title ">Quản lý đơn hàng</h4>
                  <p class="card-category">Danh sách các đơn hàng</p>
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table">
                      <thead class=" text-primary">
                        <th>Mã hóa đơn</th>
                        <th>Username</th>
                        <th>Địa chỉ giao hàng</th>
                        <th>Ghi chú</th>
                        <th>Tổng tiền ban đầu</th>
                        <th>Mã giảm giá</th>
                        <th>Tổng tiền sau giảm</th>
                        <th>Ngày lập</th>
                        <th>Tình trạng</th>
                        <th></th>
                        <th></th>
                      </thead>
                      <tbody>
                        <?php
                            while ($row = mysqli_fetch_array($rs))
                                                        {       
                            ?>
                        <tr>
                          <td>
                            <?= $row['ma_hoadon'] ?>
                          </td>
                          <td>
                            <?= $row['username'] ?>
                          </td>
                          <td>
                            <?= $row['diachigiaohang'] ?>
                          </td>
                          <td>
                            <?= $row['ghichu'] ?>
                          </td>
                          <td>
                            <?= $row['tongtienbandau'] ?>
                          </td>
                          <td>
                            <?= $row['magiamgia'] ?>
                          </td>
                          <td>
                                <?= $row['tongtiensaukhigiam'] ?>
                        </td>
                        <td>
                                <?= $row['ngaylap'] ?>
                        </td>
                        <td>
                                <?= $row['trangthai'] ?>
                        </td>
                        <td>
                          <?php
                                // <input class="xemchitiet" type="button" style="color:blue;" value="Xem chi tiết" anlong =""/>
                                ?>
                                <input type="button" value="Xem chi tiết" data-toggle="modal" data-target="#modal-xemchitiet" class="xemchitiet" anlong="<?=$row['ma_hoadon']?>">
                                <div class="modal fade" id="modal-xemchitiet">
                                  <div class="modal-dialog">
                                      <div class="modal-content">
                                        <div id="modalcontent"></div>
                                      </div>
                                  </div>
                                </div>
                        </td>
                        <td>
                                <input class="xuly" type="button" style="color:blue;" value="Xử lý" anlong ="<?=$row['ma_hoadon']?>" id="xuly" >
                        </td>
                        <td>
                                <input class="huyhoadon" type="button" style="color:blue;" value="Hủy" anlong ="<?=$row['ma_hoadon']?>" id="huyhoadon" >
                        </td>
                        </tr>
                        <?php }?>
                      </tbody>
                    </table>
                    
                  </div>
                  <?php include 'phantrangdonhang.php'?>
                  <!--<div id="test">-->

                  </div>
                </div>
              </div>
            </div>
      </div>
      <script>
      $(document).ready(function()
        {
        $(".xemchitiet").click(function()
            {
                var mahoadon = $(this).attr("anlong");
                $.post("xemchitiethoadon.php", {mahoadon: mahoadon}, function(data)
                {
                    $("#modalcontent").html(data);
                });
            });
        });
      $(document).ready(function()
        {
        $(".xuly").click(function()
            {
                var mahoadon = $(this).attr("anlong");
                var check = confirm("Xử lý hóa đơn "+mahoadon+"?");

            if(check == true)
            {
                $.post("xulyhoadon.php", {mahoadon: mahoadon}, function(data)
                {
                    alert(data);
                    var act = "qldonhang";
                    $.post("ajaxmenu.php", {act: act}, function(data){
                    $("#noidung").html(data);
                    });
            });
              }
        });
        });
      $(document).ready(function(){
        $(".huyhoadon").click(function(){
            var mahoadon = $(this).attr("anlong");
            var check = confirm("Bạn có chắc chắn hủy hóa đơn "+mahoadon+"?");

            if(check == true)
            {
                $.post("huyhoadon.php", {act: mahoadon}, function(data)
                {
                  alert("Đã hủy hóa đơn "+ mahoadon);
                  //load lai trang qlsanpham
                  var act = "qldonhang";
                $.post("ajaxmenu.php", {act: act}, function(data)
                {
                $("#noidung").html(data);
                });
                });
            }
        });
        });
    </script>
    <?php
    //include("foot.php");
    ?>