<?php include "header1.php";?>
<?php
require "ConnectDB.php";
$sosanpham1trang = 10;
$timkiem = (!empty($_GET['timkiem'])) ? $_GET['timkiem'] : "";
$trang = (!empty($_GET['trang'])) ? $_GET['trang'] : 1;
settype($trang, "int");

$from = ($trang - 1) * $sosanpham1trang;
if(!isset($timkiem))
{
$sql = "Select * from sanpham inner join menucon on menucon.id_con = sanpham.id_con where sanpham.trangthai = '1'
		limit $sosanpham1trang offset $from
	";
  $sql2 = "SELECT * FROM  `sanpham` WHERE trangthai = '1'";
} else
{
  $sql = "Select * from sanpham inner join menucon on menucon.id_con = sanpham.id_con where sanpham.trangthai = '1' and sanpham.tensp like '%$timkiem%'
    limit $sosanpham1trang offset $from
  ";
  $sql2 = "SELECT * FROM  `sanpham` WHERE trangthai = '1' and tensp like '%$timkiem%'";
}
//------------------------------------------------------
$tong = mysqli_query($con, $sql2);
$tong = $tong -> num_rows;//lấy tổng số sản phẩm
$current_page = (!empty($_GET['trang'])) ? $_GET['trang'] : 1;
//var_dump($tong);
//------------------------------------------------------
$tongTrang = ceil($tong / $sosanpham1trang);//tính tổng số trang
//var_dump($tongTrang);
$rs = mysqli_query($con, $sql);
?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-header card-header-primary">
                  <h4 class="card-title ">Danh sách sản phẩm</h4>
                  <p class="card-category">Tất cả sản phẩm đang bày bán</p>
                  <input type='button' style="float: right; color: blue;font-weight: bold; font-size: 13px; "class="themsp" value="Thêm sản phẩm"></div>
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table">
                      <thead class=" text-primary">
                        <th>Ảnh</th>
                        <th>Mã sản phẩm</th>
                        <th>Tên sản phẩm</th>
                        <th>Loại</th>
                        <th>Đơn giá</th>
                        <th>Ngày đăng bán</th>
                        <th></th>
                        <th></th>
                      </thead>
                      <tbody>
                        <div class="danhsachsanpham">
                      	<?php
                            while ($row = mysqli_fetch_array($rs))
							              {	
                            ?>
                        <tr>
                          <td>
                            <div><img style="width: 80px; height:80px; border: 1px solid purple; border-radius: 5px;" src="././<?= $row['anhsp'] ?>"></div>
                          </td>
                          <td>
                            <?= $row['masp'] ?>
                          </td>
                          <td id="tensp">
                            <?= $row['tensp'] ?>
                          </td>
                          <td id="tenMenucon">
                            <?= $row['tenMenucon'] ?>
                          </td>
                          <td id="gia">
                            <?=number_format($row['gia'],0,",",".") ?> Đ
                          </td>
                          <td>
                            <?= $row['ngaydang'] ?>
                          </td>
                      	<td>
                      		<input type="button" value="Sửa" name="" style="color:blue;" class="suasp" anlong="<?= $row['masp'] ?>" >
                      	</td>
                        <td>
                          <input class="xoasp" type="button" style="color:blue;" value="Xóa" anlong ="<?= $row['masp'] ?>">
                        </td>
                        </tr>
                        <?php }?>
                      </div>
                      </tbody>
                    </table>
                    
                  </div>
                  <?php include 'test4.php'?>
                  <!--<div id="test">-->

                  </div>
                </div>
              </div>
            </div>
   		</div>
      <script>
      $(document).ready(function(){
        $(".themsp").click(function(){
            var act = $(this).attr("anlong");
            $.post("themsanpham.php", {act: act}, function(data){
              $("#noidung").html(data);

            });
            //alert(act);
        });
      });
      $(document).ready(function(){
        $(".suasp").click(function(){
            var masp = $(this).attr("anlong");
            $.post("suasanpham.php", {masp: masp}, function(data){
              $("#noidung").html(data);
            });
            //alert(act);
        });
      });
      $(document).ready(function(){
        $(".xoasp").click(function(){
            var masp = $(this).attr("anlong");
            var check = confirm("Bạn có chắc chắn xóa sản phẩm mã "+masp+"?");

            if(check == true)
            {
                $.post("xoasanpham.php", {act: masp}, function(data)
                {
                  alert("Đã xóa sản phẩm có mã "+masp);
                  //load lai trang qlsanpham
                  var act = "qlsanpham";
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